<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	public function getDashboard()
    {	
		$posts = Post::orderBy('created_at','desc')->get();
        return view('dashboard',['posts'=>$posts]);
	}
	
	public function postCreatePost(Request $request){
		$this->validate($request,[
			'body' =>'required|max:1000'
		]);
		
		$post = new Post;
		$post->body = $request['body'];

		$message = 'there was an error';
		if($request->user()->posts($post)->save($post)){
			$message = 'posted successfully!';
		}
		return redirect()->route('dashboard')->with(['message' => $message]);
	}

	public function getDeletePost($post_id){
		$post = Post::where('id',$post_id)->first();
		if(Auth::user() != $post->user)
			return redirect()->back();
		$post->delete();
		return redirect()->route('dashboard')->with(['message' => 'deleted successfully!']);
	}

	public function postEditPost(Request $request ){
		$this->validate($request, [
			'body' =>'required'
		]);
		$post = Post::find($request['postId']);
		$post->body = $request['body'];
		$post->update();

		return response()->json(['new_body' => $post->body], 200);
	}

	public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->get();
        
        $like = null;
        foreach ($likes as $rs) {
            if($rs->user_id === $user->id){
                $like = $rs;
            }
        }
        
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                $likeCount = Like::where('user_id', $user->id)->where('like', 1)->count();
                $dislikeCount = Like::where('user_id', $user->id)->where('like', 0)->count();
                return response()->json(['likeCount' => $likeCount, 'dislikeCount' => $dislikeCount], 200);
            }
            else{
                $like->like = $is_like;
                $like->save();
                $likeCount = Like::where('user_id', $user->id)->where('like', 1)->count();
                $dislikeCount = Like::where('user_id', $user->id)->where('like', 0)->count();
                return response()->json(['likeCount' => $likeCount, 'dislikeCount' => $dislikeCount], 200);
            }
        } 
        $like = new Like();
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->save();

        $likeCount = Like::where('user_id', $user->id)->where('like', 1)->count();
        $dislikeCount = Like::where('user_id', $user->id)->where('like', 0)->count();
        return response()->json(['likeCount' => $likeCount, 'dislikeCount' => $dislikeCount], 200);
    }
}

