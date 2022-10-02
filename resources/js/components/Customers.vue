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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th class="text-right">Total Due</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="customer in customers" :key="customer.id">
                            <td>{{customer.name}}</td>
                            <td class="text-right">{{customer.total_due}} LKR</td>
                            <td class="text-right">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#customerDetails" v-on:click="openDetails(customer.id)">Show Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                customers : []
            }
        },
        mounted() {
            this.getCustomers();
        },
        methods : {
            getCustomers : function (){
                axios.post('/customers/fetch').then(response => {
                    this.customers = response.data.data.customers.data;
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
