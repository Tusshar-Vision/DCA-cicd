@extends('layouts.base')
@section('title', 'Home | Current Affairs')

@section('content')

<div>

    <label class="mb-[10px] text-[#5A7184] text-sm flex">Paper</label>
    <div class="relative w-[100%]">
        <input type="search" class="w-[100%] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('paper')" onblur="onSearchblur('paper')">
        <div id="paper" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="p-[10px] hover:bg-[#F4F6FC] cursor-pointer">GS - 1</p>
            <p class="p-[10px] hover:bg-[#F4F6FC] cursor-pointer">GS - 2</p>
        </div>
    </div>
    
    <label class="mb-[10px] mt-[20px] text-[#5A7184] text-sm flex">Subject</label>
    <div class="relative w-[100%]">
        <input type="search" class="w-[100%] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('subject')" onblur="onSearchblur('subject')">
        <div id="subject" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="p-[10px] hover:bg-[#F4F6FC] cursor-pointer">Economy</p>
        </div>
    </div>
    
    <label class="mb-[10px] mt-[20px] text-[#5A7184] text-sm flex">Section</label>
    <div class="relative w-[100%]">
        <input type="search" class="w-[100%] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('section')" onblur="onSearchblur('section')">
        <div id="section" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="p-[10px] hover:bg-[#F4F6FC] cursor-pointer">Government Budgeting and Financial Interme...</p>
            <p class="p-[10px] hover:bg-[#F4F6FC] cursor-pointer">Labour, Employment and Skill Development</p>
        </div>
    </div>

</div>

<script>

function onSearchfocus(id) {
    var x = document.getElementById(id);
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function onSearchblur(id) {
    var x = document.getElementById(id);
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
}

</script>

@endsection
