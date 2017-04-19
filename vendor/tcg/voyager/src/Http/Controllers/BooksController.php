<?php

namespace TCG\Voyager\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class BooksController extends Controller
{
    use BreadRelationshipParser;

    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('browse_' . $dataType->name);

        $getter = $dataType->server_side ? 'paginate' : 'get';

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $relationships = $this->getRelationships($dataType);

            if ($model->timestamps) {
                $dataTypeContent = call_user_func([$model->with($relationships)->latest(), $getter]);
            } else {
                $dataTypeContent = call_user_func([$model->with($relationships)->orderBy('id', 'DESC'), $getter]);
            }

            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = isBreadTranslatable($model);

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }
        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('read_' . $dataType->name);

        $relationships = $this->getRelationships($dataType);
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $dataTypeContent = call_user_func([$model->with($relationships), 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        //Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // Check if BREAD is Translatable
        $isModelTranslatable = isBreadTranslatable($dataTypeContent);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('edit_' . $dataType->name);

        $relationships = $this->getRelationships($dataType);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        // Check if BREAD is Translatable
        $isModelTranslatable = isBreadTranslatable($dataTypeContent);

        $view = 'voyager::bread.edit-add-books';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('edit_' . $dataType->name);

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        $isEmpty = $this->isRoomEmpty($id, $request->input('room_id'), date('Y-m-d', strtotime($request->input('come_date'))), date('Y-m-d', strtotime($request->input('leave_date'))));
        if ($isEmpty) {
            $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

            return redirect()
                ->route("voyager.{$dataType->slug}.edit", ['id' => $id])
                ->with([
                    'message' => "Successfully Updated {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => "This room is not empty in this date",
                    'alert-type' => 'error',
                ]);
        }
    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {
//        dd($request);
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('add_' . $dataType->name);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        // Check if BREAD is Translatable
        $isModelTranslatable = isBreadTranslatable($dataTypeContent);

        $view = 'voyager::bread.edit-add-books';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
//        dd($request);

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    // POST BRE(A)D
    public function store(Request $request)
    {

//        if($request->input("leave_date") || $request->input("come_date") ){
//        dd($request);
//
//        }
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('add_' . $dataType->name);

//        $isEmpty = $this->isRoomEmpty(0, $request->input('room_id'), date('Y-m-d', strtotime($request->input('come_date'))), date('Y-m-d', strtotime($request->input('leave_date'))));
//        if ($isEmpty) {
//        dd($request);
//            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());
//            $data = DB::insert(DB::raw());
        DB::table('books')->insert([
            ['user_id' => $request->input("user_id"),
                'room_id' => $request->input("room_id"),
                'come_date' => $request->input("come_date"),
                'leave_date' => $request->input("leave_date"),
                'number_of_adults' => $request->input("number_of_adults")
                , 'number_of_children' => $request->input("number_of_children")]
        ]);
        $data = DB::table('books')->select(DB::raw("id"))
            ->where([
                ['room_id', '=', $request->input("room_id")],
                ['user_id', '=', $request->input("user_id")],
                ['come_date', '=', $request->input("come_date")],
                ['leave_date', '=', $request->input("leave_date")],
            ])->first();
//        dd($data->id);
        return redirect()
            ->route("voyager.{$dataType->slug}.edit", ['id' => $data->id])
            ->with([
                'message' => "Successfully Added New {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
//        } else {
//            return redirect()
//                ->back()
//                ->with([
//                    'message' => "This room is not empty in this date",
//                    'alert-type' => 'error',
//                ]);
//        }
    }



    // check if room is empty
//    private function isRoomEmpty($bookId, $roomID, $comeDate, $leaveDate)
//    {
//        if ($bookId == 0) {
//            $roomBooks = DB::select(DB::raw("SELECT * FROM books WHERE room_id = $roomID and ((date(come_date) BETWEEN '$comeDate' and '$leaveDate') OR (date(leave_date) BETWEEN '$comeDate' and '$leaveDate'))"));
//        } else {
//            $roomBooks = DB::select(DB::raw("SELECT * FROM books WHERE room_id = $roomID and id <> $bookId and ((date(come_date) BETWEEN '$comeDate' and '$leaveDate') OR (date(leave_date) BETWEEN '$comeDate' and '$leaveDate'))"));
//
//        }
//        if ($roomBooks) {
//            return false;
//        } else {
//            return true;
//        }
//
//
//    }


    //***************************************
    //                _____
    //               |  __ \
    //               | |  | |
    //               | |  | |
    //               | |__| |
    //               |_____/
    //
    //         Delete an item BREA(D)
    //
    //****************************************

    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('delete_' . $dataType->name);

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        foreach ($dataType->deleteRows as $row) {
            if ($row->type == 'image') {
                $this->deleteFileIfExists('/uploads/' . $data->{$row->field});

                $options = json_decode($row->details);

                if (isset($options->thumbnails)) {
                    foreach ($options->thumbnails as $thumbnail) {
                        $ext = explode('.', $data->{$row->field});
                        $extension = '.' . $ext[count($ext) - 1];

                        $path = str_replace($extension, '', $data->{$row->field});

                        $thumb_name = $thumbnail->name;

                        $this->deleteFileIfExists('/uploads/' . $path . '-' . $thumb_name . $extension);
                    }
                }
            }
        }

        $data = $data->destroy($id)
            ? [
                'message' => "Successfully Deleted {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]
            : [
                'message' => "Sorry it appears there was a problem deleting this {$dataType->display_name_singular}",
                'alert-type' => 'error',
            ];

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }
}
