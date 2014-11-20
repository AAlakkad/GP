<?php namespace AAlakkad\RecipesFinder\Repositories\Ingredient;

interface IngredientRepository {
    function create($input);
    function validate($data);
    function getList();
    function getMultipleById($ids = []);
}
