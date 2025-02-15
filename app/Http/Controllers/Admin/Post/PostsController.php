<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Models\Attachment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostsController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     */
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $access = $this->accessCheck('post');
        if ($request->ajax()) {

            $posts = Post::with('attachment')->get();

            return DataTables::of($posts)
                ->addIndexColumn()
                ->addColumn('action', function ($item) use ($access) {
                    $btn='';
                    if ($access['isedit'] == 'Y') {
                        $btn = '<button class="btn btn-primary editPostBtn" data-id="' . $item->id . '" data-url="' . route('post.edit', $item->id) . '"><i class="bi bi-pencil-square"></i></button>';
                    }
                    if ($access['isdelete'] == 'Y') {
                        $btn .= '&nbsp;<button class="btn btn-danger ml-2 deletePostBtn" data-id="' . $item->id . '"><i class="bi bi-trash-fill"></i></button>';
                    }
                    return $btn;
                })
                ->addColumn('description', function ($desc) {
                    return strip_tags(Str::limit($desc->description, 50));
                })
                ->addColumn('type', function ($type) {
                    return ucfirst($type->type);
                })
                ->addColumn('visibility', function ($visibility) {
                    return ucfirst($visibility->visibility);
                })
                ->addColumn('image', function ($image) {
                    // return '<span class="badge bg-primary">'..'"</span>';
                    $count = $image->attachment->count();
                    return "<a type='button' data-id='" . $image->id . "'  class='imageListPopup d-flex' data-url='" . route('post.edit', $image->id) . "'><span class='btn btn-primary text-dark mx-auto'>" . $count . "</span></a>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $extraJs = array_merge(
            config('js-map.admin.summernote.script'),
            config('js-map.admin.datatable.script')
        );
        $extraCs = array_merge(
            config('js-map.admin.summernote.style'),
            config('js-map.admin.datatable.style')
        );
        return view('admin.post.post', ['extraJs' => $extraJs, 'extraCs' => $extraCs, 'access' => $access]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        DB::beginTransaction();
        try {
            $accessCheck = $this->checkAccess($this->accessCheck('post'), 'isinsert');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $post = $this->postService->storeData($data);
            if ($request->images != null) {
                foreach ($request->images as $image) {
                    $filePath = 'images/posts/';
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $path = $image->storeAs($filePath, $imageName, 'public');
                    Attachment::create([
                        'post_id' => $post->id,
                        'image' => $path
                    ]);
                }
            }
            DB::commit();
            return response()->json(['success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $accessCheck = $this->checkAccess($this->accessCheck('post'), 'isedit');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            $post = Post::with('attachment')->find($id);
            return response()->json(['status' => true, 'message' => $post]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $accessCheck = $this->checkAccess($this->accessCheck('post'), 'isupdate');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            $data = $request->validated();
            $data['user_id'] = Auth::id();

            $post = Post::find($id);
            $post->update($data);
            if ($request->images != null) {
                foreach ($request->images as $image) {
                    $filePath = 'images/posts/';
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $path = $image->storeAs($filePath, $imageName, 'public');
                    Attachment::create([
                        'post_id' => $post->id,
                        'image' => $path
                    ]);
                }
            }
            DB::commit();
            return response()->json(['success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $accessCheck = $this->checkAccess($this->accessCheck('post'), 'isdelete');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            if ($id) {
                $attachment = Attachment::where('post_id', $id);
                // $image[]=$attachment->image;
                foreach ($attachment as $file) {
                    Storage::disk('public')->delete($file->image);
                }
                $attachment->delete();
            }
            Post::find($id)->delete();
            return response()->json(['success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteImage($id)
    {
        try {
            $attachment = Attachment::find($id);
            Storage::disk('public')->delete($attachment->image);
            $attachment->delete();
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
