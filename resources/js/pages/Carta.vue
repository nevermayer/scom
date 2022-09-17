<template>
    <div class="front-wrapper">
        <div class="front-sidebar">
            <div class="brand">
                <img src="../assets/img/logo.svg" alt="">
            </div>
            <div class="front-sidemenu">
                <ul>
                    <li>
                        <div>
                            <img src="../assets/img/platillo.svg" alt="">
                            <h3 @click="getItems(category)">Platillos</h3>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="../assets/img/postre.svg" alt="">
                            <h3 @click="getItems(category)">Postres</h3>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="../assets/img/bebida.svg" alt="">
                            <h3 @click="getItems(category)">Bebidas</h3>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <Nav :cart="cart" :categories="categories" :user="user" />
        <div class="front-main">
            <div class="main-grid">
                <div class="menu-section">
                    <h3>{{selectedMenu? selectedMenu.name : ''}}</h3>

                    <div class="menu-grid" v-if="selectedMenu">
                        <div :style="`background-image: url(${item.image})`" class="menu-card"
                            v-for="(item, index) in selectedMenu.menu_items" :key="index">
                            <div>
                                <span class="bg-main-gradient item-price">
                                    <span>&#8358;</span> {{item.price}}
                                </span>
                            </div>
                            <div>
                                <span class="item-name">{{item.name}}</span>
                            </div>

                            <button class="btn btn-main-gradient" @click="updateCart(item)">
                                Add to cart
                            </button>
                        </div>
                    </div>

                </div>
                <div class="cart-section">
                    <div class="cart-card">
                        <div class="cart-header">
                            <h3>Nueva Orden</h3>
                            <small>Productos</small>
                        </div>

                        <div class="cart-body">
                            <div class="cart-items">
                                <div class="cart-item" v-for="(item, index) in cart" :key="index">
                                    <div class="cart-info">
                                        <span class="ti-trash" @click="dropItem(index)"></span>
                                        <div>
                                            <h5>{{item.name}}</h5>
                                            <small>@ {{(Number(item.price) *
                                            Number(item.qty)).toLocaleString()}}</small>
                                        </div>
                                    </div>
                                    <div class="cart-controls">
                                        <input type="text" readonly :value="item.qty">
                                        <div>
                                            <span class="ti-angle-up" @click="updateItemQty(index, item, 1)"></span>
                                            <span class="ti-angle-down" @click="updateItemQty(index, item, 0)"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-sum">
                                <div class="cart-address">
                                </div>

                                <div>
                                    <div class="price-flex">
                                        <small>Subtotal</small>
                                        <small></small>
                                    </div>

                                    <div class="price-flex">
                                        <small>Total</small>
                                        <h4></h4>
                                    </div>
                                </div>

                                <div class="cart-pay-btn">
                                    <paystack :amount="cartTotal * 100" :email="user !== null? user.email : ''"
                                        :paystackkey="paystackkey" :reference="reference" :callback="createOrder"
                                        :close="close" :embed="false" :disabled="validateCheckoutData || user === null"
                                        class="btn btn-success" v-if="user !== null && address">
                                        <span class="ti-credit-card"></span> Pay Now
                                    </paystack>

                                    <button v-else-if="!address" class="btn btn-success"
                                        @click="showAddressModal = true">
                                        Confirmar la Orden
                                    </button>

                                    <button v-else class="btn btn-success" @click="$router.push('/account')">
                                        Login to continue
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal v-if="showAddressModal" @close="showAddressModal = false">
            <h4 slot="header">Provide your address</h4>

            <div slot="body">
                <div class="form-group">
                    <label for="">Your address</label>
                    <input type="text" class="form-control" v-model="address" placeholder="No 230, Abba road" />
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
import Nav from '@/components/Nav.vue'
export default {
    name: 'carta',
    components: {
        Nav
    }
}
</script>