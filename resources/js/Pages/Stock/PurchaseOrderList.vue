<template>
    <AppLayout>
        <div class=" w-full flex justify-center">
                <label class="text-lg font-bold">รายการใบสั่งซื้อ</label>
        </div>
        <div class="flex flex-col  mb-2 text-md font-bold text-gray-900 ">
            <div class=" m-2">
                <label for="">ระบุปีงบประมาณ:</label>
                <select name="" id="" v-model="form.year_selected"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" 
                    @Change="getListPurchase"
                    >
                    <option v-for="(year,index) in  years" :key=index v-bind:value="year">{{year+543}}</option>
                </select>
            </div>
            
        </div>
        <div class=" w-full  p-2">
            <div v-for="(purchase_order) in purchase_orders" :key="purchase_order.id"
                class=" m-2 p-2 bg-pink-100 border-b-2 border-pink-600 rounded-md"
                >
                <div class=" font-bold"> {{purchase_order.stock['stockname']}}</div>
                <div> วันที่สั่งซื้อ:{{purchase_order.date_order}}</div>
                <div> ๑.ชื่อโครงการ:{{purchase_order.project_name}} จำนวน {{purchase_order.items.length}} รายการ</div>
                <div> ๒.วงเงินงบประมาณที่ได้รับจัดสรร:{{purchase_order.budget}} บาท</div>
                <div>
                    <a :href="route('print-purchase-order',purchase_order.id)"  target="blank">
                        <span
                            class="inline-flex text-sm py-1 px-2  leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                                พิมพ์แบบ บก.๐๖
                        </span>
                    </a>

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
  years:{type:Object,required:true},
})

const purchase_orders = ref('');
const form = useForm({
    year_selected:'',
})


const getListPurchase=()=>{
    console.log('getListPurchase');



    axios.get(route('get-purchase-order',{year:form.year_selected})).then(res => {
       // console.log(res.data.stocks);
        purchase_orders.value = res.data.purchase_orders;   
    });
   // forceUpdate();
}
</script>