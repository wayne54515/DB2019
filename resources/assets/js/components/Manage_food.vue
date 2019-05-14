<template>
<div class="m-container">
    <button id="show-food-create-modal" @click="showFoodInsert()">新增</button>
    <table class="data-table" border="1" cellpadding="5">
        <tbody>
            <tr>
                <td>食物編號</td>
                <td>食物名稱</td>
                <td>食物價格</td>
                <td>食物種類</td>
                <td>操作</td>
            </tr>
            <tr v-for="(food, index) in food_list" :key="food.id">
                <td>{{ food.id }}</td>
                <td>{{ food.name }}</td>
                <td>{{ food.price }}</td>
                <td>{{ food.type }}</td>
                <td>
                    <button id="show-food-edit-modal" @click="showFoodEdit(food.id, index)">編輯</button>
                    <button id="show-food-delete-modal" @click="showFoodDelete(food.id, index)">刪除</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- 編輯使用者資料表單 -->
    <modal v-if="showFoodModal" @close="showFoodModal = false">
        <div slot="header">
            <h3 v-if="foodModalState == 'insert'">新增食物</h3>
            <h3 v-if="foodModalState == 'edit'">編輯食物</h3>
        </div>

        <div slot="body">
            <div class="row"><label>食物名稱</label><input v-model="food.name"/></div>
            <div class="row"><label>食物價格</label><input type="number" min="0" v-model="food.price"/></div>
            <div class="row"><label>食物種類</label><select v-model="food.type">
                <option v-for="type in foodTypeList" :value="type" :key="type.id">
                    {{ type }}
                </option></select>
            </div>
        </div>

        <div slot="footer">
            <button class="modal-default-button" v-if="foodModalState == 'insert'" @click="insertFood()">新增</button>
            <button class="modal-default-button" v-if="foodModalState == 'edit'" @click="updateFood()">更新</button>
            <button class="modal-default-button" @click="showFoodModal = false">取消</button>
        </div>
    </modal>

    <!-- 刪除使用者表單 -->
    <modal v-if="showDeleteFoodModal" @close="showDeleteFoodModal = false">
        <div slot="header">
            <h3>刪除食物</h3>
        </div>

        <div slot="body">
            確定刪除 {{food.name}} ？
        </div>

        <div slot="footer">
            <button class="modal-default-button" @click="deleteFood(food.id, targetIndex)">刪除</button>
            <button class="modal-default-button" @click="showDeleteFoodModal = false">取消</button>
        </div>
    </modal>
</div>
</template>

<script>
import modal from './Modal.vue'

export default {
    data: function(){
        return {
            food_list: [],
            showFoodModal: false,
            showDeleteFoodModal: false,
            foodModalState: "",
            foodTypeList: ["dish", "desert", "beverage"],
            food: "",
            targetIndex: ""
        }
    },

    methods: {
        init: function(){
            this.getFoodList()
        },

        getFoodList: function(){
            let self = this;

            this.axios.get('/food')
                .then((response) => {
                    self.food_list = response.data.food;
                })
                .catch((response) => {
                    console.log(response);
                })
        },

        showFoodInsert: function(){
            this.foodModalState = "insert";
            this.showFoodModal = true;
        },

        showFoodEdit: function(id, index){
            this.foodModalState = "edit";
            this.foodIndex = index;

            let self = this;
            this.axios.get('/food/' + id + "/edit")
                .then((response) => {
                    self.food = response.data.food;
                    self.showFoodModal = true;
                })
                .catch((response) => {
                    console.log(response);
                });
        },

        showFoodDelete: function(id, index){
            this.food = this.food_list[index];
            this.targetIndex = index;
            this.showDeleteFoodModal = true;
        },

        insertFood: function(){
            let self = this;

            this.axios.post('/food', {
                'food': self.food
                })
                .then((response) => {
                    console.log('done');
                    self.showFoodModal = false;
                    self.getFoodList()
                })
                .catch((response) => {
                    console.log(response);
                })
        },

        updateFood: function(){
            let self = this;

            this.axios({
                method: 'put',
                url: '/food/' + self.food.id,
                data:{
                    'food': self.food
                }
            }).then((response) => {
                console.log('done');
                self.food_list[self.foodIndex] = self.food;
                self.showFoodModal = false;
            }).catch((response) => {
                console.log(response);
            })
        },

        deleteFood: function(id, index){
            let self = this;

            this.axios({
                method: 'delete',
                url: '/food/' + id
            }).then((response) => {
                console.log("delete");
                this.showDeleteFoodModal = false;
                this.getFoodList();
            }).catch((response) => {
                console.log(response);
            })
        }

    },

    watch: {
        foodModalState: function(value){
            if(value == "insert"){
                this.food = {
                    id: "",
                    name: "",
                    price: "",
                    type: "",
                }
            }
        }
    },

    mounted: function() {
        this.init();
    }, 
    
    components: {
        modal
    }
}
</script>

<style>
    .data-table {
        border: 1px black solid;
    }
</style>