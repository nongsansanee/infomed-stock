<template>
 <div class=" py-2 font-bold"> {{purchaseOrder.stock['stockname']}}</div>
                <div class="flex justify-between"> 
                    <p class=" text-red-700 font-bold">วันที่สั่งซื้อ:{{purchaseOrder.date_order}} </p> 
                    <p class=" bg-green-200 px-2 mx-4 text-red-700 font-bold rounded-md" >
                         สถานะ:{{purchaseOrder.status}}
                    </p>
                </div>
                <div> ๑.ชื่อโครงการ:{{purchaseOrder.project_name}} จำนวน {{purchaseOrder.items.length}} รายการ</div>
                <div> ๒.วงเงินงบประมาณที่ได้รับจัดสรร:{{budget_show}} บาท</div>
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <p class=" text-green-600 font-bold" > คุณ{{purchaseOrder.user.name}} ({{purchaseOrder.user.profile['division_name']}})</p>
                    <p class=" px-2 text-gray-600 text-sm">ผู้บันทึกข้อมูล</p>
                </div>
                <div>
                    <a :href="route('print-purchase-order',purchaseOrder.id)" 
                        v-if="$page.props.auth.user.profile.division_id==purchaseOrder.unit_id"
                         target="blank">
                        <span
                            class="inline-flex text-sm py-1 px-2  leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                                พิมพ์แบบ บก.๐๖
                        </span>
                    </a>
                    <a :href="route('print-purchase-order-item',purchaseOrder.id)"  target="blank">
                        <span
                            class="inline-flex text-sm  ml-2 py-1 px-2  leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                                พิมพ์รายการพัสดุสั่งซื้อ
                        </span>
                    </a>
                         <button v-if="purchaseOrder.status == 'created' &&  
                                $page.props.auth.user.profile.division_id==purchaseOrder.unit_id"
                            class=" inline-flex text-sm ml-3 bg-green-500 hover:bg-green-700 text-white  py-1 px-4 border border-green-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            ส่ง
                        </button>

                        <button v-if="purchaseOrder.status == 'created' &&  
                                $page.props.auth.user.profile.division_id==purchaseOrder.unit_id"
                            class=" inline-flex text-sm ml-3 bg-yellow-500 hover:bg-yellow-700 text-white  py-1 px-2 border border-yellow-500 rounded"
                            @click="editOrderPurchase(purchaseOrder.id)"
                            >
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            แก้ไข
                        </button>

                        <button v-if="purchaseOrder.status == 'created' &&  
                                $page.props.auth.user.profile.division_id==purchaseOrder.unit_id"
                            class=" inline-flex text-sm ml-3 bg-red-500 hover:bg-red-700 text-white  py-1 px-2 border border-red-500 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            ลบ
                        </button>
                </div>
  
</template>
<script setup>
import { Inertia } from '@inertiajs/inertia';
const { onMounted, ref }=require("@vue/runtime-core");

const props = defineProps({
      purchaseOrder:{type:Object,required:true},
})

const budget_show = ref(0);

onMounted(() => {
    budget_show.value = props.purchaseOrder['budget'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")

})

const editOrderPurchase=(purchase_order_id)=>{
    console.log('editOrderPurchase');
    console.log(purchase_order_id);

    Inertia.visit(route('get-edit-order-purchase'),{
       method: 'post',
        data: {
            id: purchase_order_id,
        },
   })
}

</script>
