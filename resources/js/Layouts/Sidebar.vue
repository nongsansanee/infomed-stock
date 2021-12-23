<template>
    <!-- give the sidebar z-50 class so its higher than the navbar if you want to see the logo -->
    <!-- you will need to add a little "X" button next to the logo in order to close it though -->
    <div class="overflow-y-auto w-2/3 md:w-1/3 lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block bg-gray-100 border-r z-30" :class="sideBarOpen ? '' : 'hidden'" id="main1-nav">

      <div class=" flex justify-center ">
            <img src="/storage/images/logo_med_tranparent.gif" class=" w-2/3">
             <!-- <p class="font-semibold text-2xl text-blue-400 pl-4">
          ระบบพัสดุ
        </p> -->
      </div>
      <div class="w-full  border-t flex px-4 items-center mb-4">
        <!-- <p class="font-semibold text-2xl text-blue-400 pl-4">
          ระบบพัสดุ
        </p> -->
      </div>
  <!-- {{$page.props.flash.mainMenuLinks}} -->
      <div v-if="!$page.props.flash.mainMenuLinks.is_admin_division_stock" class="mb-4 px-4 text-sm">
        <p class="pl-4  font-semibold mb-1">เมนูหลักของสาขา</p>
        <Link :href="route('stock',1)">
        <!-- <Link :href="route('helloworld')" @click="setLinkActive('helloworld')"> -->
        <!-- <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer" :class="{ 'bg-gray-200': isLinkActive('helloworld') }"> -->
        <div class="w-full flex items-center text-blue-600 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
          </svg>
          <span class="text-gray-700 ml-2">เบิกใช้พัสดุ</span>
        </div>
        </Link>
        
        <Link :href="route('report-list',1)">
        <div class="w-full flex items-center text-blue-600 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span class="text-gray-700 ml-2">รายงานการเบิกใช้พัสดุ</span>
        </div>
        </Link>

         <!-- <Link :href="route('report-stock',1)">
          <div class="w-full flex items-center text-yellow-500 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
          </svg>
          <span class="text-gray-700 ml-2">รายงานการเบิกใช้พัสดุ</span>
        </div>
        </Link> -->

        <Link :href="route('create-order',1)">
        <!-- <Link :href="route('helloworld')" @click="setLinkActive('helloworld')"> -->
        <!-- <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer" :class="{ 'bg-gray-200': isLinkActive('helloworld') }"> -->
        <div class="w-full flex items-center text-blue-600 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span class="text-gray-700 ml-2">สร้างเอกสารสั่งซื้อพัสดุ</span>
        </div>
        </Link>
        <Link :href="route('order-list',1)">
        <!-- <Link :href="route('helloworld')" @click="setLinkActive('helloworld')"> -->
        <!-- <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer" :class="{ 'bg-gray-200': isLinkActive('helloworld') }"> -->
        <div class="w-full flex items-center text-blue-600 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
          </svg>
          <span class="text-gray-700 ml-2">เอกสารสั่งซื้อพัสดุ</span>
        </div>
        </Link>
      </div>
<!-- v-if="$page.props.flash.mainMenuLinks.is_admin_division_stock" -->
      <div v-if="$page.props.flash.mainMenuLinks.is_admin_division_stock" class="mb-4 px-4 text-sm">
        <p class="pl-4  font-semibold mb-1">เมนูหลักของหน่วยพัสดุภาคฯ</p>

        <div class="w-full flex items-center justify-between text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer" @click="managementMenuOpen = !managementMenuOpen">
          <div class="flex flex-row">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
              <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z" />
              <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z" />
              <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z" />
            </svg>
            <span class="text-gray-700 ml-2">การจัดการข้อมูล</span> 
          </div>
          <i :class="managementMenuOpen ? iconExpland : iconCollapse" class="ml-2" style="fontSize: 0.7rem"></i>
        </div >
        <div :class="managementMenuOpen ? '' : 'hidden'">
          <Link href="#">
            <div class=" flex flex-col items-start ml-8 h-10 hover:bg-gray-200 rounded-lg cursor-pointer">
              <div class="mt-2"><i :class="iconSubMenu" class="pr-2 submenu-icon-style"></i>คลังพัสดุ</div>
            </div>
          </Link>
          <Link href="#">
            <div class=" flex flex-col items-start ml-8 h-10 hover:bg-gray-200 rounded-lg cursor-pointer">
              <div class="mt-2"><i :class="iconSubMenu" class="pr-2 submenu-icon-style"></i>หน่วยนับ</div>
            </div>
          </Link>
          <div class=" flex flex-col items-start ml-8 h-10 hover:bg-gray-200 rounded-lg cursor-pointer">
            <div class="mt-2"><i :class="iconSubMenu" class="pr-2 submenu-icon-style"></i>สิทธิ์ผู้ใช้งาน</div>
          </div>
          <!-- <Link :href="route('manage_workunit')"> -->
          <!-- <div class=" flex flex-col items-start ml-8 h-10 hover:bg-gray-200 rounded-lg cursor-pointer">
            <div class="mt-2"><i :class="iconSubMenu" class="pr-2 submenu-icon-style"></i>หน่วยงาน</div>
          </div> -->
          <!-- </Link> -->
        </div>

         <Link :href="route('report-list','27')">
        <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span class="text-gray-700 ml-2">ดูรายงานการเบิกพัสดุ</span>
        </div>
        </Link>

         <Link :href="route('check-order-list')">
        <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          <span class="text-gray-700 ml-2">ดูเอกสารการสั่งซื้อ</span>
        </div>
        </Link>

        <!-- <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
          </svg>
          <span class="text-gray-700 ml-2">ตรวจรับพัสดุ</span>
        </div> -->

      
      </div>

      <!-- <div class="mb-4 px-4">
        <p class="pl-4 text-sm font-semibold mb-1">ผู้ดูแลห้องประชุม</p>
        <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
          <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
            <path d="M17.592,8.936l-6.531-6.534c-0.593-0.631-0.751-0.245-0.751,0.056l0.002,2.999L5.427,9.075H2.491c-0.839,0-0.162,0.901-0.311,0.752l3.683,3.678l-3.081,3.108c-0.17,0.171-0.17,0.449,0,0.62c0.169,0.17,0.448,0.17,0.618,0l3.098-3.093l3.675,3.685c-0.099-0.099,0.773,0.474,0.773-0.296v-2.965l3.601-4.872l2.734-0.005C17.73,9.688,18.326,9.669,17.592,8.936 M3.534,9.904h1.906l4.659,4.66v1.906L3.534,9.904z M10.522,13.717L6.287,9.48l4.325-3.124l3.088,3.124L10.522,13.717z M14.335,8.845l-3.177-3.177V3.762l5.083,5.083H14.335z"></path>
          </svg>
          <span class="text-gray-700">Notices</span>
        </div>
        <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
          <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
            <path d="M6.176,7.241V6.78c0-0.221-0.181-0.402-0.402-0.402c-0.221,0-0.403,0.181-0.403,0.402v0.461C4.79,7.416,4.365,7.955,4.365,8.591c0,0.636,0.424,1.175,1.006,1.35v3.278c0,0.222,0.182,0.402,0.403,0.402c0.222,0,0.402-0.181,0.402-0.402V9.941c0.582-0.175,1.006-0.714,1.006-1.35C7.183,7.955,6.758,7.416,6.176,7.241 M5.774,9.195c-0.332,0-0.604-0.272-0.604-0.604c0-0.332,0.272-0.604,0.604-0.604c0.332,0,0.604,0.272,0.604,0.604C6.377,8.923,6.105,9.195,5.774,9.195 M10.402,10.058V6.78c0-0.221-0.181-0.402-0.402-0.402c-0.222,0-0.402,0.181-0.402,0.402v3.278c-0.582,0.175-1.006,0.714-1.006,1.35c0,0.637,0.424,1.175,1.006,1.351v0.461c0,0.222,0.181,0.402,0.402,0.402c0.221,0,0.402-0.181,0.402-0.402v-0.461c0.582-0.176,1.006-0.714,1.006-1.351C11.408,10.772,10.984,10.233,10.402,10.058M10,12.013c-0.333,0-0.604-0.272-0.604-0.604S9.667,10.805,10,10.805c0.332,0,0.604,0.271,0.604,0.604S10.332,12.013,10,12.013M14.629,8.448V6.78c0-0.221-0.182-0.402-0.403-0.402c-0.221,0-0.402,0.181-0.402,0.402v1.668c-0.581,0.175-1.006,0.714-1.006,1.35c0,0.636,0.425,1.176,1.006,1.351v2.07c0,0.222,0.182,0.402,0.402,0.402c0.222,0,0.403-0.181,0.403-0.402v-2.07c0.581-0.175,1.006-0.715,1.006-1.351C15.635,9.163,15.21,8.624,14.629,8.448 M14.226,10.402c-0.331,0-0.604-0.272-0.604-0.604c0-0.332,0.272-0.604,0.604-0.604c0.332,0,0.604,0.272,0.604,0.604C14.83,10.13,14.558,10.402,14.226,10.402 M17.647,3.962H2.353c-0.221,0-0.402,0.181-0.402,0.402v11.27c0,0.222,0.181,0.402,0.402,0.402h15.295c0.222,0,0.402-0.181,0.402-0.402V4.365C18.05,4.144,17.869,3.962,17.647,3.962 M17.245,15.232H2.755V4.768h14.49V15.232z"></path>
          </svg>
          <span class="text-gray-700">Controls</span>
        </div>
        <div class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
          <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
            <path d="M17.498,11.697c-0.453-0.453-0.704-1.055-0.704-1.697c0-0.642,0.251-1.244,0.704-1.697c0.069-0.071,0.15-0.141,0.257-0.22c0.127-0.097,0.181-0.262,0.137-0.417c-0.164-0.558-0.388-1.093-0.662-1.597c-0.075-0.141-0.231-0.22-0.391-0.199c-0.13,0.02-0.238,0.027-0.336,0.027c-1.325,0-2.401-1.076-2.401-2.4c0-0.099,0.008-0.207,0.027-0.336c0.021-0.158-0.059-0.316-0.199-0.391c-0.503-0.274-1.039-0.498-1.597-0.662c-0.154-0.044-0.32,0.01-0.416,0.137c-0.079,0.106-0.148,0.188-0.22,0.257C11.244,2.956,10.643,3.207,10,3.207c-0.642,0-1.244-0.25-1.697-0.704c-0.071-0.069-0.141-0.15-0.22-0.257C7.987,2.119,7.821,2.065,7.667,2.109C7.109,2.275,6.571,2.497,6.07,2.771C5.929,2.846,5.85,3.004,5.871,3.162c0.02,0.129,0.027,0.237,0.027,0.336c0,1.325-1.076,2.4-2.401,2.4c-0.098,0-0.206-0.007-0.335-0.027C3.001,5.851,2.845,5.929,2.77,6.07C2.496,6.572,2.274,7.109,2.108,7.667c-0.044,0.154,0.01,0.32,0.137,0.417c0.106,0.079,0.187,0.148,0.256,0.22c0.938,0.936,0.938,2.458,0,3.394c-0.069,0.072-0.15,0.141-0.256,0.221c-0.127,0.096-0.181,0.262-0.137,0.416c0.166,0.557,0.388,1.096,0.662,1.596c0.075,0.143,0.231,0.221,0.392,0.199c0.129-0.02,0.237-0.027,0.335-0.027c1.325,0,2.401,1.076,2.401,2.402c0,0.098-0.007,0.205-0.027,0.334C5.85,16.996,5.929,17.154,6.07,17.23c0.501,0.273,1.04,0.496,1.597,0.66c0.154,0.047,0.32-0.008,0.417-0.137c0.079-0.105,0.148-0.186,0.22-0.256c0.454-0.453,1.055-0.703,1.697-0.703c0.643,0,1.244,0.25,1.697,0.703c0.071,0.07,0.141,0.15,0.22,0.256c0.073,0.098,0.188,0.152,0.307,0.152c0.036,0,0.073-0.004,0.109-0.016c0.558-0.164,1.096-0.387,1.597-0.66c0.141-0.076,0.22-0.234,0.199-0.393c-0.02-0.129-0.027-0.236-0.027-0.334c0-1.326,1.076-2.402,2.401-2.402c0.098,0,0.206,0.008,0.336,0.027c0.159,0.021,0.315-0.057,0.391-0.199c0.274-0.5,0.496-1.039,0.662-1.596c0.044-0.154-0.01-0.32-0.137-0.416C17.648,11.838,17.567,11.77,17.498,11.697 M16.671,13.334c-0.059-0.002-0.114-0.002-0.168-0.002c-1.749,0-3.173,1.422-3.173,3.172c0,0.053,0.002,0.109,0.004,0.166c-0.312,0.158-0.64,0.295-0.976,0.406c-0.039-0.045-0.077-0.086-0.115-0.123c-0.601-0.6-1.396-0.93-2.243-0.93s-1.643,0.33-2.243,0.93c-0.039,0.037-0.077,0.078-0.116,0.123c-0.336-0.111-0.664-0.248-0.976-0.406c0.002-0.057,0.004-0.113,0.004-0.166c0-1.75-1.423-3.172-3.172-3.172c-0.054,0-0.11,0-0.168,0.002c-0.158-0.312-0.293-0.639-0.405-0.975c0.044-0.039,0.085-0.078,0.124-0.115c1.236-1.236,1.236-3.25,0-4.486C3.009,7.719,2.969,7.68,2.924,7.642c0.112-0.336,0.247-0.664,0.405-0.976C3.387,6.668,3.443,6.67,3.497,6.67c1.75,0,3.172-1.423,3.172-3.172c0-0.054-0.002-0.11-0.004-0.168c0.312-0.158,0.64-0.293,0.976-0.405C7.68,2.969,7.719,3.01,7.757,3.048c0.6,0.6,1.396,0.93,2.243,0.93s1.643-0.33,2.243-0.93c0.038-0.039,0.076-0.079,0.115-0.123c0.336,0.112,0.663,0.247,0.976,0.405c-0.002,0.058-0.004,0.114-0.004,0.168c0,1.749,1.424,3.172,3.173,3.172c0.054,0,0.109-0.002,0.168-0.004c0.158,0.312,0.293,0.64,0.405,0.976c-0.045,0.038-0.086,0.077-0.124,0.116c-0.6,0.6-0.93,1.396-0.93,2.242c0,0.847,0.33,1.645,0.93,2.244c0.038,0.037,0.079,0.076,0.124,0.115C16.964,12.695,16.829,13.021,16.671,13.334 M10,5.417c-2.528,0-4.584,2.056-4.584,4.583c0,2.529,2.056,4.584,4.584,4.584s4.584-2.055,4.584-4.584C14.584,7.472,12.528,5.417,10,5.417 M10,13.812c-2.102,0-3.812-1.709-3.812-3.812c0-2.102,1.71-3.812,3.812-3.812c2.102,0,3.812,1.71,3.812,3.812C13.812,12.104,12.102,13.812,10,13.812"></path>
          </svg>
          <span class="text-gray-700">Settings</span>
        </div>
      </div> -->

    </div>
</template>

<script>
import { ref } from "vue";
import { Link } from '@inertiajs/inertia-vue3'
export default {

  components: {
    Link,
  },

  props: [
    'sideBarOpen'
  ],

  setup() {
    // const activeLinkItem = ref("helloworld")

    // const isLinkActive = (linkname) => {
    //   console.log(activeLinkItem.value === linkname)
    //   return activeLinkItem.value === linkname
    // }

    // const setLinkActive = (linkname) => {
    //   console.log(`Set Active Link ${linkname}`)
    //   activeLinkItem.value = linkname
    //   //return isLinkActive(linkname)
    // }

    // return {
    //   activeLinkItem,
    //   isLinkActive, setLinkActive
    // }

    const iconCollapse = ref("pi pi-caret-right")
    const iconExpland = ref("pi pi-caret-down")
    const iconSubMenu = ref(iconCollapse.value)

    const reserveRoomMenuOpen = ref(false)
    const equipmentMenuOpen = ref(false)
    const managementMenuOpen = ref(false)

    return {
      reserveRoomMenuOpen, equipmentMenuOpen, managementMenuOpen,   //menu
      iconCollapse, iconExpland, iconSubMenu  // icon
    }
  }
}
</script>

<style scoped>
.submenu-icon-style {
    /* background-color: aquamarine; */
    color: #ffb380; 
    font-size: 0.7rem;
}

</style>