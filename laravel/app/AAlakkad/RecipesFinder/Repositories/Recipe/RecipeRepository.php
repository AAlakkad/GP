<?php namespace AAlakkad\RecipesFinder\Repositories\Recipe;

interface RecipeRepository {
    function getByIngredients($ingredients = []);
    function getSuggestionsByIngredients($ingredients = []);
    function validate($data);
    function attachIngredients($id, $ingredients = []);
    function saveWithIngredients($data, $ingredients = []);
    function create($input);
}
