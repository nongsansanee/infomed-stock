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