<?php
/*
Template Name : Dashboardテンプレート
Tamplate location : home.blade.php
*/
?>

<style>



</style>

@php
$user_name = Auth::user();
$user = Auth::user();
$id = Auth::id();
$title = 'ダッシュボード';
$page_title = "Dashboard";
$slug = "dashboard";
@endphp





@extends('layouts.list')


