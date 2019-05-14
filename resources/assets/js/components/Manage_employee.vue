<template>
<div class="m-container">
    <button id="show-employee-create-modal" @click="showEmployeeInsert()">新增</button>
    <table class="data-table" border="1" cellpadding="5">
        <tbody>
            <tr>
                <td>員工編號</td>
                <td>員工名稱</td>
                <td>員工性別</td>
                <td>工作時數(日)</td>
                <td>工作天數(月)</td>
                <td>時薪</td>
                <td>員工類型</td>
                <td>操作</td>
            </tr>
            <tr v-for="(employee, index) in employee_list" :key="employee.id">
                <td>{{ employee.id }}</td>
                <td>{{ employee.name }}</td>
                <td>{{ employee.sex }}</td>
                <td>{{ employee.work_time }}</td>
                <td>{{ employee.work_day }}</td>
                <td>{{ employee.salary }}</td>
                <td>{{ employee.type }}</td>
                <td>
                    <button id="show-employee-edit-modal" @click="showEmployeeEdit(employee.id, index)">編輯</button>
                    <button id="show-employee-delete-modal" @click="showEmployeeDelete(employee.id, index)">刪除</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- 編輯使用者資料表單 -->
    <modal v-if="showEmployeeModal" @close="showEmployeeModal = false">
        <div slot="header">
            <h3 v-if="employeeModalState == 'insert'">新增員工</h3>
            <h3 v-if="employeeModalState == 'edit'">編輯員工</h3>
        </div>

        <div slot="body">
            <div class="row"><label>員工名稱</label><input v-model="employee.name"/></div>
            <div class="row"><label>員工性別</label><select v-model="employee.sex">
                <option v-for="sex_type in sexTypeList" :value="sex_type" :key="sex_type.id">
                    {{ sex_type }}
                </option></select>
            </div>
            <div class="row"><label>工作時數(日)</label><input type="number" min="1" max="24" v-model="employee.work_time" />></div>
            <div class="row"><label>工作天數(月)</label><input type="number" min="1" max="31" v-model="employee.work_day" />></div>
            <div class="row"><label>時薪</label><input type="number" min="0" v-model="employee.salary" />></div>
            <div class="row"><label>員工類型</label><select v-model="employee.type">
                <option v-for="type in employeeTypeList" :value="type" :key="type.id">
                    {{ type }}
                </option></select>
            </div>
        </div>

        <div slot="footer">
            <button class="modal-default-button" v-if="employeeModalState == 'insert'" @click="insertEmployee()">新增</button>
            <button class="modal-default-button" v-if="employeeModalState == 'edit'" @click="updateEmployee()">更新</button>
            <button class="modal-default-button" @click="showEmployeeModal = false">取消</button>
        </div>
    </modal>

    <!-- 刪除使用者表單 -->
    <modal v-if="showDeleteEmployeeModal" @close="showDeleteEmployeeModal = false">
        <div slot="header">
            <h3>刪除員工</h3>
        </div>

        <div slot="body">
            確定刪除 {{employee.name}} ？
        </div>

        <div slot="footer">
            <button class="modal-default-button" @click="deleteEmployee(employee.id, targetIndex)">刪除</button>
            <button class="modal-default-button" @click="showDeleteEmployeeModal = false">取消</button>
        </div>
    </modal>
</div>
</template>

<script>
import modal from './Modal.vue'

export default {
    data: function(){
        return {
            employee_list: [],
            showEmployeeModal: false,
            showDeleteEmployeeModal: false,
            employeeModalState: "",
            employeeTypeList: ["cook", "waiter"],
            sexTypeList: ["male", "female"],
            employee: "",
            targetIndex: ""
        }
    },

    methods: {
        init: function(){
            this.getEmployeeList()
        },

        getEmployeeList: function(){
            let self = this;

            this.axios.get('/employee')
                .then((response) => {
                    self.employee_list = response.data.employee;
                })
                .catch((response) => {
                    console.log(response);
                })
        },

        showEmployeeInsert: function(){
            this.employeeModalState = "insert";
            this.showEmployeeModal = true;
        },

        showEmployeeEdit: function(id, index){
            this.employeeModalState = "edit";
            this.employeeIndex = index;

            let self = this;
            this.axios.get('/employee/' + id + "/edit")
                .then((response) => {
                    self.employee = response.data.employee;
                    self.showEmployeeModal = true;
                })
                .catch((response) => {
                    console.log(response);
                });
        },

        showEmployeeDelete: function(id, index){
            this.employee = this.employee_list[index];
            this.targetIndex = index;
            this.showDeleteEmployeeModal = true;
        },

        insertEmployee: function(){
            let self = this;

            this.axios.post('/employee', {
                'employee': self.employee
                })
                .then((response) => {
                    console.log('done');
                    self.showEmployeeModal = false;
                    self.getEmployeeList()
                })
                .catch((response) => {
                    console.log(response);
                })
        },

        updateEmployee: function(){
            let self = this;

            this.axios({
                method: 'put',
                url: '/employee/' + self.employee.id,
                data:{
                    'employee': self.employee
                }
            }).then((response) => {
                console.log('done');
                self.employee_list[self.employeeIndex] = self.employee;
                self.showEmployeeModal = false;
                self.employee = null;
            }).catch((response) => {
                console.log(response);
            })
        },

        deleteEmployee: function(id, index){
            let self = this;

            this.axios({
                method: 'delete',
                url: '/employee/' + id
            }).then((response) => {
                console.log("delete");
                this.showDeleteEmployeeModal = false;
                this.getEmployeeList();
            }).catch((response) => {
                console.log(response);
            })
        }

    },

    watch: {
        employeeModalState: function(value){
            if(value == "insert"){
                this.employee = {
                    id: "",
                    name: "",
                    sex: "",
                    work_time: null,
                    work_day: null,
                    salary: null,
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