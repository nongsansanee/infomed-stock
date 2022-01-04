<template>
      <div class="w-full  p-2  ">
  {{stock_item}}
  -------------
  {{form.item}}
        <div 
                class="w-full   bg-red-100 border-2 border-red-200 mt-3  rounded-lg lg:max-w-full lg:flex lg:flex-col">
                 <div class="flex ml-2"> {{index+1}}. 
                    <p class=" ml-2 ">  {{stock_item.item_code}}:{{stock_item.item_name}}</p> 
                    <p class=" ml-2 text-red-600" >
                             <span  
                                class="inline-flex px-2  text-lg font-semibold leading-5  rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            {{stock_item.item_sum}}
                            </span>
                    </p> 
                </div>
                <div class="flex ml-6">
                     <p class=" ml-2 text-xs ">  {{stock_item.checkin_last.profile['catalog_number']}}/{{stock_item.checkin_last.profile['lot_number']}}</p> 
                </div>
                <div  class="flex ml-6">
                     <div class=" w-1/4 py-2 px-2 text-right"> จำนวนสั่งซื้อ:</div>
                     <div class=" w-3/4 ">
                     <input type="number"   placeholder="จำนวนสั่งซื้อ"   v-model="form.unit"
                            class="block w-full mt-1 border-gray-400 rounded-md ">
                     </div>
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> Cat.No:</div>
                    <div class=" w-3/4 ">
                      <input type="text"  v-model="stock_item.checkin_last.profile['catalog_number']" 
                            class="block w-full mt-1   border-gray-400 rounded-md ">
                    </div>
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> Lot.No:</div>
                    <div class=" w-3/4 ">
                      <input type="text"  v-model="stock_item.checkin_last.profile['lot_number']" v-bind:ref="'cat_no-'+stock_item.id"
                            class="block w-full mt-1   border-gray-400 rounded-md ">
                    </div>
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> ราคาต่อหน่วย:</div>
                    <div class=" w-3/4 ">
                     <input type="number"  v-model="stock_item.price" 
                            class="block w-full mt-1  border-gray-400 rounded-md ">
                    </div>
                </div>
                  <div class="flex ml-6 mt-2">
                    <div class=" w-1/4 py-2 px-2 text-right"> บริษัทผู้ขาย:</div>
                    <div class=" w-3/4 ">
                      <select 
                        class="block appearance-none w-full  bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight " >
                        <option v-for="(business) in  businesses" :key=business.id 
                            v-bind:value="{item_id:stock_item.id,business_id:business.id,business_name:business.business_name}"
                            >
                            {{business.business_name}}
                        </option>
                        </select>
                    </div>
                </div>
                <div class=" m-2">
                    
                          <button
                            class="w-full flex justify-center text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                            v-on:click="checkedOrder(index)"
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
const { useForm, usePage }=require("@inertiajs/inertia-vue3");
const { onMounted, ref }=require("@vue/runtime-core");

const props = defineProps({
    index:{type:Number , required:true},
    stock_item: { type: Object ,required:true },
    businesses:{type:Object ,required:true}
})

// const cat_no=ref();

const form = useForm({
    item:[],
    // order_selected:[],
    // preview_orders: [{
    //                     stock_id:0,
    //                     id:0,
    //                     sap:0,
    //                     item_name:'',
    //                     unit:0,
    //                     price:0,
    //                     business_id:0,
    //                     business_name:'',
    //                     total:0,
    //                     catalog_number:'',
    //                     lot_number:'',
    //                 }],

    // business_selected:[],
    stock_id:0,
    item_id:0,
    item_name:'',
    sap:0,
    unit:0,
    cat_no:'',
    lot_no:'',
    price:0,
    business_id:0,
    business_name:'',
   

})
console.log('stock_item#######>'+usePage().props.value.stock_item);
//form.item = usePage().props.value.stock_item;

// onMounted(() => {
//     console.log('onMounted');
//      console.log('index-->'+usePage().props.value.index);
//     console.log('stock_item-->'+usePage().props.value.stock_item);
//      form.item = usePage().props.value.stock_item;
//      console.log(form.item);
    
// })

const checkedOrder = (index)=>{
        console.log('checkedOrder');
        console.log('index->'+index);
        console.log('item_id->'+form.items[index].item_id);
        console.log('item_name->'+form.items[index].item_name);
        console.log('unit->'+form.unit);
        console.log('price->'+form.price);
        console.log('cat_no->'+form.item.checkin_last.profile['catalog_number']);
     //   form.order_selected=[];
           
      //  console.log('itemsChecked->'+form.preview_orders.length)  
            // form.order_selected.forEach(item => {
            //      console.log(item.id);
            //     //   console.log(this.$refs['check-'+item.id].);
            //     if(this.$refs['item-'+item.id].value=='')
            //     {
            //             alert('กรุณาใส่จำนวนที่ต้องการสั่งซื้อ');
            //             this.$refs['itemcheck-'+item.id].value=false;
            //             return;
            //     }

            //     // console.log(this.business_selected);
            //     // console.log(this.business_selected[item.id]);
             

            //     let total_bath = this.$refs['item-'+item.id].value*this.$refs['price-'+item.id].value;
              
            //    form.order_selected.push({
            //                             stock_id:form.items[index].stock_id,
            //                             id:form.items[index].id,
            //                             sap:form.items[index].sap,
            //                             item_name:form.items[index].item_name,
            //                             // unit:this.$refs['item-'+item.id].value,
            //                             // price:this.$refs['price-'+item.id].value,
            //                             // business_id:this.business_selected[item.id].business_id,
            //                             // business_name:this.business_selected[item.id].business_name,
            //                             // total:total_bath,
            //                             // catalog_number:this.$refs['cat_no-'+item.id].value,
            //                             // lot_number:this.$refs['lot_no-'+item.id].value,
            //                         });
            //   console.log('itemsChecked->'+form.preview_orders.length) 
            
            
}

</script>