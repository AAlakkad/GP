<?php namespace AAlakkad\RecipesFinder\Repositories;

abstract class BaseRepository
{
    protected $per_page;

    public function __construct()
    {
        $this->per_page = \Config::get( 'app.items_per_page', 10 );
    }

    protected function getPerPage()
    {
        return $this->per_page;
    }

    public function paginate()
    {
        return $this->model->paginate( $this->per_page );
    }

    public function getById( $id )
    {
        return $this->model->findOrFail( $id );
    }

    public function delete( $id )
    {
        $this->model->delete( $id );
    }
}
