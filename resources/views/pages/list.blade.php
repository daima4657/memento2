
<?php
/*
Template Name : Listテンプレート
Tamplate location : pages/list.blade.php
*/
?>

<style>



</style>


@php
$user_name = Auth::user();
$user = Auth::user();
$id = Auth::id();
$title = $user->name.'さんのショーケース | ';
$page_title = "Showcase";
$slug = "list";
@endphp

@extends('layouts.list')
