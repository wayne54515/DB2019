<template>
<div class="m-container">
    <button id="show-user-create-modal" @click="showUserInsert()">新增</button>
    <table class="data-table" border="1" cellpadding="5">
        <tbody>
            <tr>
                <td>使用者編號</td>
                <td>使用者名稱</td>
                <td>使用者帳號</td>
                <td>操作</td>
            </tr>
            <tr v-for="(user, index) in user_list" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <button id="show-user-edit-modal" @click="showUserEdit(user.id, index)">編輯</button>
                    <button id="show-user-delete-modal" @click="showUserDelete(user.id, index)">刪除</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- 編輯使用者資料表單 -->
    <modal v-if="showUserModal" @close="showUserModal = false">
        <div slot="header">
            <h3 v-if="userModalState == 'insert'">新增使用者</h3>
            <h3 v-if="userModalState == 'edit'">編輯使用者</h3>
        </div>

        <div slot="body">
            <div class="row"><label>使用者名稱</label><input v-model="user.name"/></div>
            <div class="row"><label>使用者帳號</label><input type="email" v-model="user.email"/></div>
            <div class="row"><label>使用者類型</label><select v-model="user.type">
                <option v-for="type in userTypeList" :value="type" :key="type.id">
                    {{ type }}
                </option></select>
            </div>

            <div class="row" v-if="userModalState == 'insert'">
                <label>設定密碼</label><input type="password" v-model="user.password" />
            </div>
        </div>

        <div slot="footer">
            <button class="modal-default-button" v-if="userModalState == 'insert'" @click="insertUser()">新增</button>
            <button class="modal-default-button" v-if="userModalState == 'edit'" @click="updateUser()">更新</button>
            <button class="modal-default-button" @click="showUserModal = false">取消</button>
        </div>
    </modal>

    <!-- 刪除使用者表單 -->
    <modal v-if="showDeleteUserModal" @close="showDeleteUserModal = false">
        <div slot="header">
            <h3>刪除使用者</h3>
        </div>

        <div slot="body">
            確定刪除 {{user.name}} 使用者？
        </div>

        <div slot="footer">
            <button class="modal-default-button" @click="deleteUser(user.id, targetIndex)">刪除</button>
            <button class="modal-default-button" @click="showDeleteUserModal = false">取消</button>
        </div>
    </modal>
</div>
</template>

<script>
import modal from './Modal.vue'

export default {
    data: function(){
        return {
            user_list: [],
            showUserModal: false,
            showDeleteUserModal: false,
            userModalState: "",
            userTypeList: ["normal", "admin"],
            user: "",
            targetIndex: ""
        }
    },

    methods: {
        init: function(){
            this.getUserList()
        },

        getUserList: function(){
            let self = this;

            this.axios.get('/user')
                .then((response) => {
                    self.user_list = response.data.users;
                })
                .catch((response) => {
                    console.log(response);
                })
        },

        showUserInsert: function(){
            this.userModalState = "insert";
            this.showUserModal = true;
        },

        showUserEdit: function(id, index){
            this.userModalState = "edit";
            this.userIndex = index;

            let self = this;
            this.axios.get('/user/' + id + "/edit")
                .then((response) => {
                    self.user = response.data.user;
                    self.showUserModal = true;
                })
                .catch((response) => {
                    console.log(response);
                });
        },

        showUserDelete: function(id, index){
            this.user = this.user_list[index];
            this.targetIndex = index;
            this.showDeleteUserModal = true;
        },

        insertUser: function(){
            let self = this;

            this.axios.post('/user', {
                'user': self.user
                })
                .then((response) => {
                    console.log('done');
                    self.showUserModal = false;
                    self.getUserList()
                })
                .catch((response) => {
                    console.log(response);
                })
        },

        updateUser: function(){
            let self = this;

            this.axios({
                method: 'put',
                url: '/user/' + self.user.id,
                data:{
                    'user': self.user
                }
            }).then((response) => {
                console.log('done');
                self.user_list[self.userIndex] = self.user;
                self.showUserModal = false;
            }).catch((response) => {
                console.log(response);
            })
        },

        deleteUser: function(id, index){
            let self = this;

            this.axios({
                method: 'delete',
                url: '/user/' + id
            }).then((response) => {
                console.log("delete");
                this.showDeleteUserModal = false;
                this.getUserList();
            }).catch((response) => {
                console.log(response);
            })
        }

    },

    watch: {
        userModalState: function(value){
            if(value == "insert"){
                this.user = {
                    id: "",
                    type: "normal",
                    name: "",
                    email: "",
                    password: ""
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