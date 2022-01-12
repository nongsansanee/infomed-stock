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
        
        <!-- <Link :href="route('report-list',1)">
        <div class="w-full flex items-center text-blue-600 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span class="text-gray-700 ml-2">รายงานการเบิกใช้พัสดุ</span>
        </div>
        </Link> -->

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
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
          </svg>
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
          <span class="text-gray-700 ml-2">ข้อมูลคลังพัสดุ</span>
        </div>
        </Link>

        <Link :href="route('report-checkout-item',27)">
          <div class="w-full flex items-center text-yellow-500 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
              </svg>
              <span class="text-gray-700 ml-2">ข้อมูลการเบิกใช้พัสดุ</span>
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