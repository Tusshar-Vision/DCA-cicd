@extends('layouts.base')
@section('title', 'Home | Current Affairs')

@section('content')

<div>
    <!-- search filter -->
    <!-- <label class="mb-[10px] text-[#5A7184] text-sm flex">Paper</label>
    <div class="relative w-[100%]">
        <input type="search" placeholder="Paper" class="w-[100%] px-[20px] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('paper')" onblur="onSearchblur('paper')">
        <div id="paper" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">GS - 1</p>
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">GS - 2</p>
        </div>
    </div>
    
    <label class="mb-[10px] mt-[20px] text-[#5A7184] text-sm flex">Subject</label>
    <div class="relative w-[100%]">
        <input type="search" placeholder="Subject" class="w-[100%] px-[20px] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('subject')" onblur="onSearchblur('subject')">
        <div id="subject" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">Economy</p>
        </div>
    </div>
    
    <label class="mb-[10px] mt-[20px] text-[#5A7184] text-sm flex">Section</label>
    <div class="relative w-[100%]">
        <input type="search" placeholder="Section" class="w-[100%] px-[20px] rounded-md border-[#C3CAD9]" onfocus="onSearchfocus('section')" onblur="onSearchblur('section')">
        <div id="section" class="absolute z-10 left-0 top-[42px] w-[100%] max-h-[150px] hidden overflow-auto rounded-md bg-[#FCFCFC]">
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">Government Budgeting and Financial Interme...</p>
            <p class="py-[10px] px-[20px] hover:bg-[#F4F6FC] cursor-pointer">Labour, Employment and Skill Development</p>
        </div>
    </div> -->

    <div class="relative w-[100%]">
        <select id="cars" class="rounded-md broder-[#C3CAD9] text-[#5A7184] w-full">
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="opel">Opel</option>
            <option value="audi">Audi</option>
        </select>
    </div>

    <div class="flex justify-end mt-[25px]">
        <button class="vi-outline-button h-10 mr-[15px] rounded-tr-md rounded-br-md w-32 cursor-pointer flex items-center justify-center">Cancel</button>
        <button class="vi-primary-button vi-search-btn h-10 rounded-tr-md rounded-br-md w-32 cursor-pointer flex items-center justify-center">Apply</button>
    </div>
    <!-- search filter -->


    

</div>




<!-- <script>

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

</script> -->

@endsection
