<template>
<AppLayout>
        <div class="w-full p-2 ">
                <div v-if="$page.props.auth.user.profile.division_name=='stockmed' ">
                        <h1 class=" text-center font-bold text-lg">บันทึกข้อมูลใบสั่งซื้อ(เก่า)</h1>
                </div>
                <div v-if="$page.props.auth.user.profile.division_id < 19 ">
                        <h1 class=" text-center font-bold text-lg">สร้างเอกสารใบสั่งซื้อ</h1>
                </div>
                <div class=" p-2 bg-green-100 border-2 border-green-300 rounded-md ">
                        
                        <div>
                                {{form.user_division}}
                                <div class="flex justify-start ">
                                        <svg xmlns="http://www.w3.org/2000/svg" v-if="stock_alert" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        <label >ชื่อคลังพัสดุ:</label>
                                </div>
                               
                                <select v-model="form.stock_select"
                                        class="block appearance-none w-full bg-white border  focus:border-indigo-600  rounded-md  " 
                                        :class="[stock_alert ? 'border-red-500 border-3 ' : 'border-gray-500' ]"
                                        >
                                        <option v-for="(stock) in  stocks" :key=stock.id  
                                                v-bind:value="{stockid:stock.id,stockname:stock.stockname}">
                                                {{stock.stockname}}
                                        </option>
                                </select>
                        </div>
                      
                        <div class=" my-2 ">
                                <div class="flex justify-start ">
                                        <svg xmlns="http://www.w3.org/2000/svg" v-if="date_alert" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        <label >วันที่สั่งซื้อ:</label>
                                </div>
                                <input type="date" name="" id=""
                                    v-model="form.date_purchase"
                                    class="w-full py-2 rounded-md appearance-none focus:border-indigo-600 "
                                    :class="[date_alert ? 'border-red-500 border-2 ' : 'border-gray-500' ]"
                                >
                        </div>
                        <div class=" my-2 ">
                                <div class="flex justify-start ">
                                        <svg xmlns="http://www.w3.org/2000/svg" v-if="project_name_alert" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        <label >ชื่อโครงการ:</label>
                                </div>
                                <input type="text" name="" id=""
                                    v-model="form.project_name"
                                    class="w-full  py-2 rounded-md  "
                                    
                                 >
                        </div>
                        <div class=" my-2 ">
                                <div class="flex justify-start ">
                                        <svg xmlns="http://www.w3.org/2000/svg" v-if="budget_alert" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        <label >ใช้งบประมาณ(บาท):</label>
                                </div>
                                <input type="text" name="" id=""
                                    v-model="show_total_bath"
                                    class="w-full  py-2 bg-gray-300 rounded-md  "
                                    readonly
                                 >
                        </div>
                            <!-- {{form.preview_orders}} -->
                        <div v-if="form.preview_orders.length!=0"
                                class=" p-2 border-2 border-green-600 rounded-md">
                               
                                <label class="font-bold">รายการพัสดุที่สั่งซื้อ:</label>
                                <div v-for="(order,index) in form.preview_orders" :key=order.id
                                        class=" bg-white my-2"
                                        >
                                        <div>
                                                {{index+1}}. {{order[0].item_name}} ({{order[0].material}})   บริษัท {{order[0].business_name}}
                                                <button class=" p-1 bg-red-600 text-white rounded-full "
                                                   @click="removeItem(index)"
                                                  >
                                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                </button>
                                        </div>
                                    
                                        <div class=" pl-4">
                                                จำนวน {{order[0].order_input}} {{order[0].unit_count}} 
                                                x {{order[0].price}}  ราคารวม {{order[0].total}} บาท 
                                        </div>
                                      
                                </div>
                              
                             
                        </div>
                        <div v-if="form.preview_orders.length!=0"
                          class=" mt-2"
                          >
                                <button 
                                        class="w-full flex justify-center bg-green-600 py-2 text-md shadow-sm font-medium  border text-white rounded-md hover:shadow-lg hover:bg-green-400"
                                        v-on:click="addOrderPurchase"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                        </svg>
                                        บันทึกใบสั่งซื้อ
                                </button>
                        </div>
                </div>
                <PurchaseItem 
                            @previewOrder="getOrder"
                         />

                <ModalUpToYou :isModalOpen="confirm_add_purchase" >
                        <template v-slot:header>
                        <p class="text-md font-bold text-red-600 ">คุณต้องการบันทึกการสั่งซื้อใช่หรือไม่?</p> 
                                                
                        </template>

                        <template v-slot:body>
                        <div class="  text-gray-900 text-md font-medium dark:text-white">
                                <div><label for="">{{form.stock_select.stockname}}</label></div>
                                <div><label for="">วันที่สั่งซื้อ: {{form.date_purchase}}</label></div>
                                <div><label for="">ราคารวม: {{show_total_bath}} บาท</label></div>
                                <div><label for="">จำนวน: {{form.preview_orders.length}} รายการ</label></div>
                        </div>
                        </template>

                        <template v-slot:footer>
                        <div class=" w-full  text-center  md:block">
                                <button 
                                class="mx-4 md:mb-0 bg-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-white rounded-full hover:shadow-lg hover:bg-green-400"
                                v-on:click="okConfirmAddPurchase"
                                >
                                ตกลง
                                </button>
                                <button 
                                class="mx-4 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600"
                                v-on:click="cancelAddPurchase"
                                >
                                ยกเลิก
                                </button>
                        </div>
                        </template>
                </ModalUpToYou>

                <ModalUpToYou :isModalOpen="show_alert_msg" >
                        <template v-slot:header>
                        <p class="text-md font-bold text-red-600 ">กรุณาอ่าน </p> 
                                                
                        </template>
                        <template v-slot:body>
                        <div class="w-full flex flex-col text-gray-900 text-md font-medium dark:text-white">
                                <div for="">
                                {{ $page.props.flash.status }}:{{ $page.props.flash.msg }} 
                                
                                </div>
                        </div>
                        </template>
                
                        <template v-slot:footer>
                        <div class=" w-full  text-center  md:block">
                                <button 
                                class="mx-4 md:mb-0 bg-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-white rounded-full hover:shadow-lg hover:bg-green-400"
                                v-on:click="closeAlert"
                                >
                                ตกลง
                                </button>
                        
                        </div>
                        </template>
                </ModalUpToYou>
         </div>
</AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PurchaseItem from '@/Components/PurchaseItem.vue'
import ModalUpToYou from '@/Components/ModalUpToYou.vue'
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from '@vue/reactivity';
import { onMounted } from '@vue/runtime-core';

defineProps({
   stocks:{type:Object,required:true},
})

const stock_alert=ref(false);
const date_alert=ref(false);
const budget_alert=ref(false);
const project_name_alert=ref(false);
const show_total_bath=ref('');
const confirm_add_purchase=ref(false);
const show_alert_msg=ref(false);

const form=useForm({
        date_purchase:'',
        stock_select:'',
        //budget_purchase:0,
        preview_orders:[],
        total_budget:0.0,
        project_name:'ขออนุมัติจัดจ้างซื้อวัสดุทางการแพทย์ วัสดุวิทยาศาสตร์ สารเคมี น้ำยาทดสอบ และวัสดุอื่นๆ โดยวิธีเฉพาะเจาะจง',
      //  user_division:0,
})

 onMounted(() => {
  //  console.log('onMounted');

   // form.user_division = usePage().props.value.auth.user.profile.division_id;
   
     
})

const getOrder=(item)=>{
   // console.log('Parent getOrder  item----->');
   // console.log(item[0].total);
    form.total_budget += Number(item[0].total);
    show_total_bath.value= form.total_budget.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   //console.log(show_total_bath.value);
    form.preview_orders.push(item);
   // console.log(form.total_budget);
    // console.log(form.preview_orders.length)   
    
}

const removeItem=(index)=>{
        // console.log(form.preview_orders[index]);
        // console.log(form.preview_orders[index][0].total);
        form.total_budget -= Number(form.preview_orders[index][0].total);
        form.preview_orders.splice(index ,1);
       
}
const addOrderPurchase=()=>{
      //  console.log('addOrderPurchase');
        // console.log(form.stock_select);
        // console.log(form.stock_select.stockid);
        // console.log(form.stock_select.stockname);
        // console.log(form.date_purchase);
        // console.log(form.total_budget);
        if(form.stock_select.stockid==0){
                stock_alert.value = true;
                return false;
        }else{
                stock_alert.value = false;
        }

        if(form.date_purchase.length==0){
                date_alert.value = true;
        }else{
                date_alert.value = false;
        }

        confirm_add_purchase.value = true;
}

const okConfirmAddPurchase=()=>{
       // console.log('okConfirmAddPurchase');
        confirm_add_purchase.value = false;
        
        form.post(route('store-purchase'), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: page => { 
                        console.log('success');
                        form.date_purchase = '';
                        form.preview_orders = [];
                        show_total_bath.value = '';
                        form.total_budget = 0.0;
                },
                onError: errors => { 
                      //  console.log('error');
                },
                onFinish: visit => { //console.log('finish');
                },
        })
        show_alert_msg.value = true;
}

const cancelAddPurchase=()=>{
        confirm_add_purchase.value = false;
}

const  closeAlert=()=>{
    // console.log('close alert');
    show_alert_msg.value = false;
   // Inertia.visit(route('budget-list'));

}
</script>
