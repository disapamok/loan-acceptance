<template>
    <div class="container loans">
        <div class="row">
            <div class="col-lg-12 heading">
                <h4>Customers</h4>
                <p>Customers who have taken loans.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="data-showcase">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th class="text-right">Total Due</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="customer in customers.data" :key="customer.id">
                                <td>{{customer.name}}</td>
                                <td class="text-right">{{customer.total_due}} LKR</td>
                                <td class="text-right">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#customerDetails" v-on:click="openDetails(customer.id)">Show Details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                <pagination class="float-right" :data="customers" :show-disabled="true" @pagination-change-page="getCustomers"></pagination>
            </div>
        </div>
        <viewCustomer ref="viewCustomer"/>
    </div>
</template>


<script>
    import viewCustomer from './Modals/viewCustomer.vue';
    export default {
        components : {
            viewCustomer
        },
        data(){
            return {
                customers : {}
            }
        },
        mounted() {
            this.getCustomers();
        },
        methods : {
            getCustomers : function (page = 1){
                axios.post('/customers/fetch?page='+page).then(response => {
                    this.customers = response.data.data.customers;
                }).catch(function (){
                    alert('error');
                });
            },
            openDetails : function(customerID){
                this.$refs.viewCustomer.modelOpened(customerID);
            }
        }
    }
</script>
