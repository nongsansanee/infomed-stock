<template>
    <AppLayout>
    <!-- {{ $page.props.flash.mainMenuLinks }} -->
        <div v-if="$page.props.flash.status=='success'" 
                class="alert-banner  fixed  right-0 m-2 w-5/6 md:w-full max-w-sm ">
                <input type="checkbox" class="hidden" id="banneralert">
                
                <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-300 shadow rounded-md text-green-800 font-bold" title="close" for="banneralert">
                 {{ $page.props.flash.msg }}
                   <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </label>
        </div>
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
           
        </div>
     
  <!-- <div v-if="$page.props.flash.status=='success'" class="w-full mx-auto shadow-md rounded-md p-2 mt-2 text-black bg-green-200 border-white">
        <label for=""> {{ $page.props.flash.msg }}</label>
  </div> -->
  <!-- {{stock_item_sum}} -->
  <!-- {{$page.props.can_abilities}} -->
  <!-- {{$page.props.can}} -->
    <div class="w-full mt-3 p-2  ">
  
        <div v-for="(stock_item,key) in stock_items" :key=stock_item.id
                class="w-full bg-pink-100 mt-3  rounded-lg lg:max-w-full lg:flex">
            
            <div
             class="flex flex-col bg-pink-200 items-center overflow-hidden text-center  bg-cover rounded-t lg:h-auto lg:w-36 lg:rounded-t-none lg:rounded-l"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <!-- icon zoom -->
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                </svg> -->
            </div>
            
            <div
            class="w-full  leading-normal  border-b border-l border-r border-gray-200 rounded-b lg:border-l-0 lg:border-t lg:border-gray-200 lg:rounded-b-none lg:rounded-r"
            >
                <div class=" mb-2">
                
                    <div class="p-2 text-md font-bold text-gray-900">
                        {{key+1}}.
                        SAP:{{stock_item.item_code}}
                        <label for="" class="text-blue-600">{{stock_item.item_name}}</label>
                        (หน่วย: {{stock_item.unit_count.countname}})
                        <Link :href="route('list-stock-item',stock_item)">
                        <span
                            class="inline-flex text-md font-semibold leading-5 text-green-800 bg-green-200 rounded-lg"
                        >
                            ประวัติการรับเข้าและเบิกออก
                        </span>
                        </Link>
                    </div>
                
                
                    <div class="flex flex-col lg:flex-col mb-2 text-md font-bold text-gray-900">
                        <div class=" flex ml-2"> จำนวนที่มี : 
                            <p class=" ml-2 text-red-600" >
                             <span  
                                class="inline-flex px-2  text-lg font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            {{stock_item.item_sum}}
                            </span>
                            </p> 
                        </div>
                        <div class="flex ml-2"> วันหมดอายุ : 
                            <p class=" ml-2 text-blue-600">{{stock_item.checkin_last.date_expire}}</p> 
                        </div>
                        <div class="flex ml-2"> วันที่รับเข้า : 
                            <p class=" ml-2 text-blue-600">{{stock_item.checkin_last.date_action}}</p> 
                        </div>
                        <div class="flex ml-2"> Cat.No/Lot.No : 
                            <p class=" ml-2 text-blue-600">{{stock_item.checkin_last.profile['catalog_number']}} /{{stock_item.checkin_last.profile['lot_number']}}</p> 
                        </div>
                      
                    </div>
                
                
                    <div v-if="can.checkout_item && stock_item.item_sum!=0" class="flex flex-col lg:flex-row mb-2 text-md font-bold text-gray-900">
                        <div class=" m-2">
                            <label for="">วันที่เบิก:</label>
                            <input type="date" name="" id=""
                                v-model="form.date_checkout[key]"
                                class="w-full px-12 py-2 border-2 rounded-md appearance-none focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500">
                        </div>
                        <div class=" m-2">
                            <label for="">จำนวน:</label>
                            <input type="number" name="" id="" 
                                v-model="form.unit_checkout[key]"
                            class="w-full px-12 py- border-2 rounded-md appearance-none focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500">
                        </div>
                    
                        
                    </div>

                    <div v-if="can.checkout_item && stock_item.item_sum!=0" class="flex flex-col lg:flex-row px-2 py-2  ">
                      
                        <button
                            class=" flex justify-center px-4 py-1   text-sm  text-white bg-green-600 rounded-md hover:bg-green-400 focus:outline-none"
                            v-on:click="confirmCheckout(key,stock_item)"
                        >
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg> -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            บันทึกการเบิก
                        </button>
                    </div>
                </div>
            <!-- <div class="flex items-center">
            
                <div class="text-sm">
                <p class="leading-none text-gray-900">Jonathan Reinink</p>
                <p class="text-gray-600">Aug 18</p>
                </div>
            </div> -->
            
            </div>
        
        </div>

        <!-- Modal -->
  
        <!-- End Modal -->

        <ModalUpToYou :isModalOpen="confirm_checkout" >

            <template v-slot:header>
                <!-- <div class="text-gray-900 text-xl font-medium dark:text-white">
                    คุณต้องการลบข้อมูลบุคคลากร
                </div> -->
                <p class="text-md font-bold text-red-600 ">คุณต้องการบันทึกการเบิกพัสดุรายการนี้ใช่หรือไม่?</p> 
                                        
            </template>

            <template v-slot:body>
                <div class="text-gray-900 text-md font-medium dark:text-white">
                    <p class="mt-2">{{form.confirm_item_name}} เบิกใช้วันที่ {{ form.confirm_item_date}} จำนวน {{form.confirm_item_count}} ชิ้น</p>   
                </div>
            </template>

            <template v-slot:footer>
                <div class=" w-full  text-center  md:block">
                    <button 
                        class="mx-4 md:mb-0 bg-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-white rounded-full hover:shadow-lg hover:bg-green-400"
                        v-on:click="okConfirmCheckout"
                        >
                        ตกลง
                    </button>
                    <button 
                        class="mx-4 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600"
                        v-on:click="cancelConfirmCheckout"
                    >
                        ยกเลิก
                    </button>
                </div>
            </template>
        </ModalUpToYou>
    
    </div>
   
    </AppLayout>
</template>
<script setup>

import ModalUpToYou from '@/Components/ModalUpToYou.vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3'
import { onBeforeMount, onMounted, ref } from '@vue/runtime-core';

defineProps({
    stocks:Array,
    stock_items:Array,
    unit:Object,
    errors: Object,
    can_abilities: { type: Object, required: true },
    can: { type: Object, required: true },
});

const confirm_checkout=ref(false);

const form = useForm({
    unit_checkout:[],
    date_checkout:[],
    // item_balance:0,
   // confirm_checkout:0,
    confirm_item_name:'',
    confirm_item_slug:'',
    confirm_item_date:'',
    confirm_item_count:'',
   // stock_item_sum:[], //เอาตัวแปร จาก props มาใช้
})

onBeforeMount(()=>{
           console.log('onBeforeMount');
})

onMounted(() => {
    console.log('onMounted');
   //   form.stock_item_sum = usePage().props.value.stock_items;
     
})

const confirmCheckout=(index,stock_item)=>{
    console.log('confirmCheckout');
    confirm_checkout.value = true;
    form.confirm_item_slug = stock_item.slug;
    form.confirm_item_name = stock_item.item_name;
    form.confirm_item_date = form.date_checkout[index];
    form.confirm_item_count = form.unit_checkout[index];
       
}

const cancelConfirmCheckout = ()=>{
    confirm_checkout.value = false;
}

const okConfirmCheckout=()=>{
    confirm_checkout.value = false;
    console.log('OK Confirm');
    form.post(route('checkout-stock-item'), {
        preserveState: false,
        preserveScroll: true,
        onSuccess: page => { console.log('success');},
        onError: errors => { 
            console.log('error');
        },
        onFinish: visit => { console.log('finish');},
    })
  
}


</script>
 