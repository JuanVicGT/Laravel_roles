<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Scripts -->
    <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
      <header
         class="
            fixed
            w-full
            bg-blue-500
            flex
            justify-between
            items-center
            px-4
            md:px-12
            transition-all
            duration-200
            h-24
         "
         
      >
         <a href="#">
            <img
               src="https://res.cloudinary.com/thirus/image/upload/v1631988912/logos/chitchat-logo_pkpwwu.png"
               alt="ChitChat Logo"
               class="h-12 transform origin-left transition duration-200"
               :class="{'scale-100': !scrolledFromTop, 'scale-75': scrolledFromTop}"
            />
         </a>
         <nav x-data="{navOpen: false, scrolledFromTop: false}">
            <button class="md:hidden" @click="navOpen = !navOpen">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-8 w-8 text-white"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
               >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
               </svg>
            </button>
            <ul
               class="
                  overflow-y-scroll max-h-screen
                  fixed
                  left-0
                  right-0
                  min-h-screen
                  px-4
                  pt-8
                  space-y-4
                  bg-blue-500
                  text-white
                  transform
                  transition
                  duration-300
                  translate-x-full
                  md:relative md:flex md:space-x-10 md:min-h-0 md:px-0 md:py-0 md:space-y-0 md:translate-x-0
               "
               :class="{'translate-x-full': !navOpen}"
               :class="{'translate-x-0': navOpen}"
            >
               <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
                             <li class="">
                  <a href="#" @click="navOpen = false">Home</a>
               </li>
               <li class="">
                  <a href="#features" @click="navOpen = false">Features</a>
               </li>
               <li>
                  <a href="#about" @click="navOpen = false">About</a>
               </li>
               <li>
                  <a href="#contact" @click="navOpen = false">Contact</a>
               </li>
            </ul>
         </nav>
      </header>
      <section class="pt-32 pb-16 px-8 md:px-12 bg-blue-500">
         <div class="max-w-7xl mx-auto md:flex md:items-center md:justify-between">
            <div class="md:flex-1 md:mr-6">
               <h1 class="font-bold text-4xl md:text-5xl text-white leading-tight">
                  The Quickest way to Chat with your Loved Ones
               </h1>
               <p class="mt-4 text-lg text-white">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis aspernatur magni vitae veritatis.
               </p>
            </div>
            <div class="md:flex-1">
               <img
                  src="https://res.cloudinary.com/thirus/image/upload/v1632162912/logos/chat_ys7mog.svg"
                  alt="Chat with loved ones"
               />
            </div>
         </div>
      </section>
      <section id="features" class="min-h-screen"></section>
      <section id="about" class="min-h-screen bg-gray-100"></section>
      <section id="contact" class="min-h-screen"></section>
   </body>

</html>
