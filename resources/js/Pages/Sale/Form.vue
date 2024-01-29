<template>
    <div>
        <form @submit.prevent="submitForm">
        <div class="col-12 mt-5 px-5">
            <div class="form-group ">
                <label for="customer" class="col-md-2">Customer Name:</label>
                <input type="text" v-model="customer" >
            </div>
            <table class="table table-sm text-center">
                <thead>
                    <tr>
                        <th>#SN</th>
                        <th>Name</th>
                        <th>QTY</th>
                        <th>Rate</th>
                        <th class="discount">Dis(%)</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td><input v-model="item.name" type="text" name="name[]" class="name"></td>
                        <td><input v-model="item.quantity" type="number" name="quantity[]" class="quantity" @input="calculateTotal"></td>
                        <td><input v-model="item.price" type="number" name="price[]" class="price" @input="calculateTotal"></td>
                        <td><input v-model="item.discount" type="number" name="discount[]" class="discount" @input="calculateTotal"></td>
                        <td><input v-model="item.total" type="number" name="total[]" class="total" disabled></td>
                        <td>
                            <button @click="duplicateRow(index)"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 50 50">
                                <path d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 24 13 L 24 24 L 13 24 L 13 26 L 24 26 L 24 37 L 26 37 L 26 26 L 37 26 L 37 24 L 26 24 L 26 13 L 24 13 z"></path>
                                </svg></button>
                            <button @click="removeRow(index)"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 48 48">
                                <path fill="#9575CD" d="M34,12l-6-6h-8l-6,6h-3v28c0,2.2,1.8,4,4,4h18c2.2,0,4-1.8,4-4V12H34z"></path><path fill="#7454B3" d="M24.5 39h-1c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5h1c.8 0 1.5.7 1.5 1.5v19C26 38.3 25.3 39 24.5 39zM31.5 39L31.5 39c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5l0 0c.8 0 1.5.7 1.5 1.5v19C33 38.3 32.3 39 31.5 39zM16.5 39L16.5 39c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5l0 0c.8 0 1.5.7 1.5 1.5v19C18 38.3 17.3 39 16.5 39z"></path><path fill="#B39DDB" d="M11,8h26c1.1,0,2,0.9,2,2v2H9v-2C9,8.9,9.9,8,11,8z"></path>
                                </svg></button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 float-right">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <th>Sub Total</th>
                        <td>:</td>
                        <td><input v-model="subtotal" type="number" name="subtotal" id="subtotal" disabled></td>
                    </tr>
                    <tr>
                        <th>Invoice Disount</th>
                        <td>:</td>
                        <td><input v-model="invoiceDiscount" type="number" name="discount" id="invoice-discount" @input="calculateTotal"></td>
                    </tr>
                    <tr>
                        <th>Payable</th>
                        <td>:</td>
                        <td><input v-model="payable" type="number" name="payable" id="payable" disabled></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary bg-success">Submit</button>
        </div>

        </form>
    </div>
</template>
<script>
export default {
    data() {
            return {
                items: [{
                    name: '',
                    quantity: 0,
                    price: 0,
                    discount: 0,
                    total: 0
                }],
                subtotal: 0,
                invoiceDiscount: 0,
                payable: 0,
                customer:'Unknown Customer'
            };
        },
        methods: {
            duplicateRow(index) {
                const newItem = {
                    name: '',
                    quantity: 0,
                    price: 0,
                    discount: 0,
                    total: 0
                };
                this.items.splice(index + 1, 0, newItem);
                this.calculateTotal();
            },
            removeRow(index) {
                if (this.items.length > 1) {
                    this.items.splice(index, 1);
                    this.calculateTotal();
                }
            },
            calculateTotal() {
                const subtotal = this.items.reduce((sum, item) => {
                    const total = item.quantity * item.price * (1 - item.discount / 100);
                    item.total = Math.round(total);
                    return sum + total;
                }, 0);
                this.subtotal = parseFloat(Math.round(subtotal)).toFixed(2);
                const final= this.subtotal - this.invoiceDiscount;
                 this.payable= final.toFixed(2);
            },
            submitForm() {
            // Prepare the data to be sent to the backend
            const formData = {
                items: this.items,
                subtotal: this.subtotal,
                invoiceDiscount: this.invoiceDiscount,
                payable: this.payable,
                customer:this.customer,
            };
            console.log(formData);
            this.$inertia.post(route('sale.store'), formData);
            },
        }
}
</script>
<style lang="">

</style>
