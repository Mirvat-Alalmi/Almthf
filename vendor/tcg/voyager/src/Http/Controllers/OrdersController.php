<?php

namespace TCG\Voyager\Http\Controllers;

use App\Models\FoodType;
use App\Models\OrderMeal;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class OrdersController extends Controller
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
//        dd($dataTypeContent);
        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }
//        dd($dataTypeContent);
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

        $foodTypes = FoodType::all();
//        dd($meals);
        // Check permission
        Voyager::canOrFail('edit_' . $dataType->name);

        $relationships = $this->getRelationships($dataType);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        // Check if BREAD is Translatable
        $isModelTranslatable = isBreadTranslatable($dataTypeContent);

        $view = 'voyager::bread.edit-add-order';

        if (view()->exists("voyager::$slug.edit-add-order")) {
            $view = "voyager::$slug.edit-add-order";
        }
        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'foodTypes'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('edit_' . $dataType->name);

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

//        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);
//
//        return redirect()
//            ->route("voyager.{$dataType->slug}.edit", ['id' => $id])
//            ->with([
//                'message' => "Successfully Updated {$dataType->display_name_singular}",
//                'alert-type' => 'success',
//            ]);


        $this->validate($request, [
            'user_id' => 'required',
            'address' => 'required|min:5',
            'order_date_time' => 'required',
            'foods' => 'required',
        ]);

//        dd($request);
        $newOrder = Order::find();
        $newOrder->user_id = $request->input('user_id');
        $newOrder->address = $request->input('address');
        $newOrder->order_date_time = gmdate('Y-m-d H:i:s', strtotime($request->input('order_date_time')));
        $newOrder->done_id = $request->input('done_id');
        $newOrder->created_at = gmdate('Y-m-d H:i:s', strtotime(Carbon::now()->toDateTimeString()));
        $newOrder->updated_at = gmdate('Y-m-d H:i:s', strtotime(Carbon::now()->toDateTimeString()));
        $newOrder->save();

        $amounts = $request->input('amounts');

        foreach ($request->input('foods') as $food) {
            $orderFood = new OrderMeal();
            $orderFood->order_id = $newOrder->id;
            $orderFood->meal_id = $food;
            $orderFood->amount = $amounts[$food];
            $orderFood->save();
        }
        return redirect()
            ->route("voyager.{$dataType->slug}.edit", ['id' => $newOrder->id])
            ->with([
                'message' => "Successfully Added New {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);

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
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        $foodTypes = FoodType::all();
//        dd($meals);
        // Check permission
        Voyager::canOrFail('add_' . $dataType->name);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        // Check if BREAD is Translatable
        $isModelTranslatable = isBreadTranslatable($dataTypeContent);

        $view = 'voyager::bread.edit-add-order';

        if (view()->exists("voyager::$slug.edit-add-order")) {
            $view = "voyager::$slug.edit-add-order";
        }
//        dd($dataType->addRows);
        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'foodTypes'));
    }

    // POST BRE(A)D
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
//        dd(Carbon::now()->toDateTimeString());
//        dd($request->input($dataType->addRows->field));

        // Check permission
        Voyager::canOrFail('add_' . $dataType->name);

//        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());
//        return redirect()
//            ->route("voyager.{$dataType->slug}.edit", ['id' => $data->id])
//            ->with([
//                'message' => "Successfully Added New {$dataType->display_name_singular}",
//                'alert-type' => 'success',
//            ]);

        $this->validate($request, [
            'user_id' => 'required',
            'address' => 'required|min:5',
            'order_date_time' => 'required',
            'foods' => 'required',
        ]);

//        dd($request);
        $newOrder = new Order();
        $newOrder->user_id = $request->input('user_id');
        $newOrder->address = $request->input('address');
        $newOrder->order_date_time = gmdate('Y-m-d H:i:s', strtotime($request->input('order_date_time')));
        $newOrder->done_id = $request->input('done_id');
        $newOrder->created_at = gmdate('Y-m-d H:i:s', strtotime(Carbon::now()->toDateTimeString()));
        $newOrder->updated_at = gmdate('Y-m-d H:i:s', strtotime(Carbon::now()->toDateTimeString()));
        $newOrder->save();

        $amounts = $request->input('amounts');
//dd($amounts);
        foreach ($request->input('foods') as $food) {
            $orderFood = new OrderMeal();
            $orderFood->order_id = $newOrder->id;
            $orderFood->meal_id = $food;
            $orderFood->amount = $amounts[$food];
            $orderFood->save();
        }
        return redirect()
            ->route("voyager.{$dataType->slug}.edit", ['id' => $newOrder->id])
            ->with([
                'message' => "Successfully Added New {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);


    }



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
