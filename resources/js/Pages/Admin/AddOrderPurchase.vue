<template>
<AppLayout>
        <div class="w-full p-2 ">
                <div>
                        <h1 class=" text-center font-bold text-lg">บันทึกข้อมูลใบสั่งซื้อ(เก่า)</h1>
                </div>
                <div>
                        <div>
                                <div class="flex justify-start ">
                                        <svg xmlns="http://www.w3.org/2000/svg" v-if="stock_alert" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        <label >ชื่อคลังพัสดุ:</label>
                                </div>
                               
                                <select v-model="form.stock_id"
                                        class="block appearance-none w-full bg-white border  focus:border-indigo-600  rounded-md   focus:outline-none focus:shadow-outline" 
                                        :class="[stock_alert ? 'border-red-500 border-2 ' : 'border-gray-500' ]"
                                        >
                                        <option v-for="(stock) in  stocks" :key=stock.id  v-bind:value="stock.id">{{stock.stockname}}</option>
                                </select>
                        </div>
                        <div class=" my-2 ">
                                 <label >วันที่สั่งซื้อ:</label>
                                <input type="date" name="" id=""
                                    v-model="form.date_purchase"
                                    class="w-full px-12 py-2 rounded-md appearance-none focus:border-indigo-600 "
                                >
                        </div>
                        <div class=" my-2 ">
                                 <label >ใช้งบประมาณ(บาท):</label>
                                <input type="number" name="" id=""
                                    v-model="form.budget_purchase"
                                    class="w-full px-12 py-2 rounded-md appearance-none focus:border-indigo-600 "
                                >
                        </div>
                        <div class=" my-2 ">
                                 <label >เลขที่ใบสั่งซื้อ:</label>
                                <input type="number" name="" id=""
                                    v-model="form.order_no_purchase"
                                    class="w-full px-12 py-2 rounded-md appearance-none focus:border-indigo-600 "
                                >
                        </div>
                        <div>
                                <button 
                                        class="w-full  bg-green-600 py-2 text-sm shadow-sm font-medium  border text-white rounded-md hover:shadow-lg hover:bg-green-400"
                                        v-on:click="addOrderPurchase"
                                        >
                                        บันทึก
                                </button>
                        </div>
                </div>
         </div>
</AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from '@vue/reactivity';
defineProps({
   stocks:{type:Object,required:true},
})

const stock_alert=ref(false);
// const msg_alert=ref('');

const form=useForm({
        date_purchase:'',
        stock_id:0,
        budget_purchase:{type:Number},
        order_no_purchase:{type:Number},
})

const addOrderPurchase=()=>{
        console.log('addOrderPurchase');
        console.log(form.stock_id);
        if(form.stock_id==0){
                stock_alert.value=true
                // msg_alert.value="กรุณาเลือกชื่อคลังพัสดุ";
        //  console.log('กรุณาระบุวันที่เบิก');
        //  document.getElementById("order_in").focus();
                return false;
        }else{
                stock_alert.value=false;
        }
}
</script>
