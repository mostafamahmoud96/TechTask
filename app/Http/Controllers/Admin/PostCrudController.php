<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // dd(backpack_user()->roles());
        if (!backpack_user()->hasRole('Admin')) {
            $this->crud->addClause('where', 'user_id', backpack_user()->id);
        }


        $this->crud->addColumn([
            'name' => 'slug', // The db column name
            'label' => "slug Name", // Table column heading
            'type' => 'Text'
        ]);
        $this->crud->addColumn([
            'name' => 'body', // The db column name
            'label' => "body", // Table column heading
            'type' => 'Text'
        ]);
        $this->crud->addColumn([
            'name' => 'descritpion', // The db column name
            'label' => "descritpion", // Table column heading
            'type' => 'Text'
        ]);
        $this->crud->addColumn([
            'name' => 'user.name', // The db column name
            'label' => "owner of post", // Table column heading
            'type' => 'Text'
        ]);
     
        $this->crud->addColumn([
            'name' => 'category.name', // The db column name
            'label' => "Category", // Table column heading
            'type' => 'Text'
        ]);


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PostRequest::class);
        CRUD::addFields([
            [
                'name'  => 'slug',
                'label' => 'Slug',
                'type'  => 'text',
            ],
            [
                'name'  => 'body',
                'label' => 'Body OF Post',
                'type'  => 'text',
            ],
            [
                'name'  => 'descritpion',
                'label' => 'descritpion',
                'type'  => 'text',
            ],
            [
                'label'     => "Category",
                'type'      => 'select',
                'name'      => 'category_id', // the db column for the foreign key
                'model'     => "App\Models\Category",
                'attribute' => 'name',
                'entity'    => 'category',
                'allows_null' => false,
                'wrapper'   => [
                    'class'      => 'form-group col-md-12 required'
                ],
            ],
        ]);

        if (backpack_user()->hasRole('Admin')) {
            CRUD::addFields([
                    [
                        'name' => 'status',
                        'label' => "Status",
                        'type' => 'radio',
                        'options' => [
                            Post::STATUS_TYPE_PENDING => trans('dashboard.statuses.' . Post::STATUS_TYPE_PENDING),
                            Post::STATUS_TYPE_ACCEPTED => trans('dashboard.statuses.' . Post::STATUS_TYPE_ACCEPTED),
                            Post::STATUS_TYPE_REJECTED => trans('dashboard.statuses.' . Post::STATUS_TYPE_REJECTED),
                        ],
                    ],
                    [
                        'name'      => 'user_id', // the db column for the foreign key
                        'label'     => "User",
                        'type'      => 'select',
                        'model'     => "App\Models\User",
                        'attribute' => 'name',
                        'entity'    => 'user',

                    ],
                ]);



            }



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    public function store()
    {
        $this->crud->hasAccessOrFail('create');
        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        $data = $request->all();

        $data['user_id'] = backpack_user()->id;
        $data['status'] = Post::STATUS_TYPE_PENDING;
        $item = $this->crud->create($data);
        $this->data['entry'] = $this->crud->entry = $item;
        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();
        // save the redirect choice for next time
        $this->crud->setSaveAction();
        return $this->crud->performSaveAction($item->getKey());
    }
}
