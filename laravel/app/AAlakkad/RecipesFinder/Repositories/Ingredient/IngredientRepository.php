<?php namespace AAlakkad\RecipesFinder\Repositories\Ingredient;

interface IngredientRepository {
    function validate($data);
    function getList();
    function getMultipleById($ids = []);
}
