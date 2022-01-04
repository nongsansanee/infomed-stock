<template>
      <div class="w-full  p-2  ">
        <div 
                class="w-full   bg-red-100 border-2 border-red-200 mt-3  rounded-lg lg:max-w-full lg:flex lg:flex-col">
                 <div class="flex ml-2"> {{item_index+1}}. 
                    <p class=" ml-2 ">  {{modelItem.item_code}}:{{modelItem.item_name}}</p> 
                    <p class=" ml-2 text-red-600" >
                             <span  
                                class="inline-flex px-2  text-lg font-semibold leading-5  rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            {{modelItem.item_sum}}
                            </span>
                    </p> 
                </div>
            
                <div  class="flex ml-6">
                     <div class=" w-1/4 py-2 px-2 text-right"> จำนวนสั่งซื้อ:</div>
                     <div class=" w-3/4 ">
                     <input type="number"   placeholder="จำนวนสั่งซื้อ"   v-model="modelUnitOrder"
                            class="block w-full mt-1 border-gray-400 rounded-md "
                            >
                     </div>
                     {{modelUnitOrder}}
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> Cat.No:</div>
                    <div class=" w-3/4 ">
                      <input type="text"  v-model="modelItem.checkin_last.profile['catalog_number']" 
                            class="block w-full mt-1   border-gray-400 rounded-md "
                            >
                    </div>
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> Lot.No:</div>
                    <div class=" w-3/4 ">
                      <input type="text"  v-model="modelItem.checkin_last.profile['lot_number']" 
                            class="block w-full mt-1   border-gray-400 rounded-md "
                            >
                    </div>
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> ราคาต่อหน่วย:</div>
                    <div class=" w-3/4 ">
                     <input type="number"  v-model="modelItem.price" 
                            class="block w-full mt-1  border-gray-400 rounded-md ">
                    </div>
                </div>
                  <div class="flex ml-6 mt-2">
                    <div class=" w-1/4 py-2 px-2 text-right"> บริษัทผู้ขาย:</div>
                    <div class=" w-3/4 ">
                      <select 
                        class="block appearance-none w-full  bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight " >
                        <option v-for="(business) in  modelBusinesses" :key="business.id" 
                            >
                            {{business.business_name}}
                        </option>
                        </select>
                    </div>
                </div>
                <div class=" m-2">
                    
                          <button
                            class="w-full flex justify-center text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                            ref="input"
                            @click="click"
                        >
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8  " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                           ใส่ตะกร้า
                        </button>
                </div>
                        
                
        </div>
    </div>
</template>
<script setup>

import {  useForm, usePage } from '@inertiajs/inertia-vue3'
import { onMounted} from '@vue/runtime-core';
import { ref } from '@vue/reactivity';

const emits = defineEmits(['update:modelItem','update:modelUnitOrder'])
const props = defineProps({
    modelBusinesses:{type:Object ,required:true},
    item_index:{type:Number , required:true},
    modelItem: { type: Object ,required:true },
    modelUnitOrder:{type:Number , required:true},

})
const input = ref(null);
    // console.log('created');
    // console.log(props.modelItem);
  

const form = useForm({
 //   item:[],
  //  modelUnitOrder:0,
   })

//form.item = props.stock_item;
// console.log('form.modelUnitOrder-->');
// console.log( form.modelUnitOrder);

const click = (event) => {
     console.log('click-->');
    console.log(props.modelItem);
    console.log(props.modelUnitOrder);
     console.log(event.target.ref);
    emits('update', event.target.value);
   // emits('update:modelUnitOrder', event.target.value);
  
};


// const inputUnitOrder = (event) => {
//     console.log('input-->');
//     console.log( form.modelUnitOrder);
//     console.log(event.target.value);
//    //console.log('click unit_order==>'+form.unit_order);  
//     emits('updUnitOrder', event.target.value);
    
// };


</script>