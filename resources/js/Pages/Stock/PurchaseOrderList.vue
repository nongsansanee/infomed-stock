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
            <div class=" text-red-500">
                note:เพิ่มตัวกรองค้นหาด้วยชื่อสาขา/หน่วย
            </div>
        </div>
        <div class="flex flex-col p-2 bg-yellow-100">
            <label class=" font-bold text-red-500">ขั้นตอน/คำแนะนำ:(ให้ user ยืนยันขั้นตอนการทำงาน)</label>
            <label >1.กดปุ่มพิมพ์แบบ บก.๐๖ เพื่อเสนอหัวหน้าสาขาเซ็น</label>
            <label >2.หลังจากหัวหน้าสาขาเซ็นแล้ว ให้กดปุ่มส่ง พร้อมส่งเอกสารแบบ บก.๐๖ ตัวจริงมาให้หน่วยพัสดุ สำนักงานภาคฯ</label>
        </div>
        <div v-if="purchase_orders.length !=0" class=" w-full  py-4">
            <div v-for="(purchase_order) in purchase_orders" :key="purchase_order.id"
                class=" m-2 p-2 bg-pink-100 border-b-2 border-pink-600 rounded-md"
                >
                <!-- {{purchase_order}} -->
                    <!-- @purchaseOrder = "purchase_order" -->
                <ShowPurchaseOrder 
                    :purchase-order="purchase_order"
                />
               
            </div>
           
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ShowPurchaseOrder from '@/Components/ShowPurchaseOrder.vue';
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
    //console.log('getListPurchase');
    axios.get(route('get-purchase-order',{year:form.year_selected})).then(res => {
       // console.log(res.data.stocks);
        purchase_orders.value = res.data.purchase_orders;   
    });
   // forceUpdate();
}

</script>