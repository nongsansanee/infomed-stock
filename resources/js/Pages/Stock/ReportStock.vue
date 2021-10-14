<template>
    <AppLayout>
        <div class=" w-full  bg-blue-100 p-2 rounded-md ">
            <div class="bg-blue-800 text-white text-xl text-center ">
                {{$page.props.unit.unitname}}
            </div>
            <div class="mt-3" >
                <label for="">เลือกคลังพัสดุ</label> 
            </div>
            <select name="" id="" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                <option v-for="(stock) in  $page.props.stocks" :key=stock.id value="{{stock.id}}">{{stock.stockname}}</option>
            </select>
           
        <!-- {{$page.props.stock_items}} -->
        </div>
        <!-- show stock items -->
        <!-- <div class="w-full mt-3 p-2 bg-blue-400 rounded-md">
            <div  v-for="(stock_item) in  $page.props.stock_items" :key=stock_item.id
            class=" mt-2 bg-green-50 rounded-sm">
                    {{stock_item.item_code}} {{stock_item.item_name}}
            </div>
            
        </div> -->

        <!-- EX1 -->
        <div class="mt-8">
            <h4 class="text-red-600">***ระบุปีและเดือน ที่ต้องการส่งรายงาน</h4>
            <div class="flex flex-col  mb-2 text-md font-bold text-gray-900 ">
                <div class=" m-2">
                    <label for="">ปี พ.ศ.</label>
                     <select name="" id="" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                        <option v-for="(year,index) in  years" :key=index value="{{year}}">{{year}}</option>
                    </select>
                </div>
                <div class=" m-2">
                    <label for="">เดือน</label>
                    <select name="" id="" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                        <option v-for="(month) in  months" :key=month.id value="{{month.id}}">{{month.name}}</option>
                    </select>
                    
                </div>  
             
            </div>
            <div class="flex flex-col  ">
                <!-- <button
                    class="px-3 py-1  text-sm text-gray-700 bg-gray-400 rounded-md hover:bg-gray-300 focus:outline-none"
                >
                    Cancel
                </button> -->
                <button
                    class=" flex justify-center px-8 py-1   text-sm  text-white bg-green-600 rounded-md hover:bg-green-400 focus:outline-none"
                >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    ดูข้อมูลการเบิก
                </button>
            </div>

            <div class="flex flex-col mt-6">
                <div
                    class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
                >
                    <div
                        class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg"
                    >
                        <table class="min-w-full">
                        <thead>
                            <tr>
                            <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left uppercase text-white border-b bg-blue-800"
                            >
                                ชื่อพัสดุ
                            </th>
                            <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left  text-white border-b bg-blue-800"
                            >
                                Cat.No
                            </th>
                            <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left  text-white border-b bg-blue-800"
                            >
                                Lot.No
                            </th>
                            <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left uppercase text-white border-b bg-blue-800"
                            >
                                วันหมดอายุ
                            </th>
                            <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left uppercase text-white border-b bg-blue-800"
                            >
                                วันที่รับเข้า
                            </th>
                            <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left uppercase text-white border-b bg-blue-800"
                            >
                                จำนวนที่มี
                            </th>
                            <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left uppercase text-white border-b bg-blue-800"
                            >
                                วันที่เบิก
                            </th>
                              <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left uppercase text-white border-b bg-blue-800"
                            >
                                จำนวน
                            </th>
                            <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left uppercase text-white border-b bg-blue-800"
                            >
                                ผู้เบิก
                            </th>
                             <th
                                class="px-2 py-3 text-md font-medium leading-4 tracking-wider text-left uppercase text-white border-b bg-blue-800"
                            >
                                จำนวนคงเหลือ
                            </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                           
                            <tr v-for="(stock_item) in $page.props.stock_items" :key=stock_item.id
                             class="hover:bg-gray-200">
                            <td
                                class="px-4 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                                <div class="flex items-center">
                                    <div class="ml-2">
                                       
                                        <div
                                        class="text-sm font-medium leading-5 "
                                        >

                                        {{ stock_item.item_code }}
                                        </div>
                                        <div class="text-sm leading-2 flex">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                                                </svg>
                                            </div>
                                           <div>
                                             <a href="#" class=" font-bold hover:text-blue-300 "
                                                >
                                               
                                                {{ stock_item.item_name}}  
                                             </a>
                                             (หน่วย:{{ stock_item.unit_count_id}})
                                             </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-2 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                                <div class="text-sm leading-5 text-gray-900">
                                {{ stock_item.catalog_number }}
                                </div>
                               
                            </td>

                            <td
                                class="px-2 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                               {{ stock_item.lot_number }}
                            </td>

                            <td
                                class="px-2 py-4 text-sm leading-5 text-red-600 border-b border-gray-200 whitespace-nowrap"
                            >
                                {{ stock_item.date_expire}}
                            </td>
                            <td
                                class="px-2 py-4 text-sm leading-5  border-b border-gray-200 whitespace-nowrap"
                            >
                                {{ stock_item.date_receive}}
                            </td>
                             <td
                                class="px-2 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200 whitespace-nowrap"
                            >
                                <span
                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                                >
                                {{ stock_item.item_receive}}
                                </span>
                            </td>
                             <td
                                class="px-2 py-4 text-sm leading-5  border-b border-gray-200 whitespace-nowrap"
                            >
                                {{ stock_item.date_receive}}
                            </td>
                            <td
                                class="px-2 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200 whitespace-nowrap"
                            >
                                <span
                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-blue-200 rounded-full"
                                >
                                {{ stock_item.item_receive-2}}
                                </span>
                            </td>
                             <td
                                class="px-2 py-4 text-sm leading-5  border-b border-gray-200 whitespace-nowrap"
                            >
                                นายทดสอบ เบิกพัสดุ
                            </td>
                            <td
                                class="px-2 py-4 text-sm leading-5  border-b border-gray-200 whitespace-nowrap"
                            >
                                 <span
                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-red-200 rounded-full"
                                >
                                0
                                </span>
                            </td>
                            <!-- <td
                                class="px-6 py-4 text-sm font-medium leading-5 text-right border-b border-gray-200 whitespace-nowrap"
                            >
                                <a href="#" class=" bg-green-200 px-2 text-lg text-green-800 rounded-md shadow-md hover:text-indigo-900"
                                >เบิก</a
                                >
                            </td> -->
                            </tr>
                            
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END TABLE -->

              <div class=" mt-6 flex flex-col  ">
                <!-- <button
                    class="px-3 py-1  text-sm text-gray-700 bg-gray-400 rounded-md hover:bg-gray-300 focus:outline-none"
                >
                    Cancel
                </button> -->
                <button
                    class=" flex justify-center px-8 py-1   text-sm  text-white bg-green-600 rounded-md hover:bg-green-400 focus:outline-none"
                >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    ยืนยันส่งรายงาน
                </button>

                <button
                    class=" flex justify-center mt-3 px-8 py-1   text-sm  text-white bg-green-600 rounded-md hover:bg-green-400 focus:outline-none"
                >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    พิมพ์รายงาน
                </button>
                <button
                    class=" flex justify-center mt-3 px-8 py-1   text-sm  text-white bg-green-600 rounded-md hover:bg-green-400 focus:outline-none"
                >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    export excel file
                </button>
            </div>
        </div>
        

    </AppLayout>
</template>
<script>
//import { ref } from 'vue';
//import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
        Link,
    },
    props:{
        stocks:Array,
        stock_items:Array,
        unit:Array,
    },
    data(){
        return{
            years:['2022','2021','2020','2019','2018'],
           
           months:[
				{id:1,name:'มกราคม' },
				{id:2,name:'กุมภาพันธ์' },	
				{id:3,name:'มีนาคม' },	
                {id:4,name:'เมษายน' },	
                {id:5,name:'พฤษภาคม' },	
                {id:6,name:'มิถุนายน' },	
                {id:7,name:'กรกฎาคม' },	
                {id:8,name:'สิงหาคม' },	
                {id:9,name:'กันยายน' },	
                {id:10,name:'ตุลาคม' },	
                {id:11,name:'ฟฤศจิกายน' },	
                {id:12,name:'ธันวาคม' },		
			],
        }
    },

    // setup() {
    
    //     return { };
    // },
}

</script>
