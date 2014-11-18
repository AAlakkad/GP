<?php namespace AAlakkad\RecipesFinder\Repositories\Recipe;

interface RecipeRepository {
    function getRecipesByIngredients($ingredients = []);
    function validate($data);
    function attachIngredients($id, $ingredients = []);
    function saveWithIngredients($data, $ingredients = []);
}
