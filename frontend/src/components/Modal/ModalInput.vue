<template>
    <div>
        

        <!-- Modal -->
        <div class="modal" :class="{ 'is-active': showModal }">
            <div class="modal-background" @click="showModal = false"></div>
            <div class="modal-content">
                <!-- Form input -->
                <form @submit.prevent="createOrder">
                    <label for="name">Nama Pesanan:</label>
                    <input type="text" id="name" v-model="newOrder.name" required>

                    <label for="amount">Jumlah:</label>
                    <input type="number" id="amount" v-model="newOrder.amount" required>

                    <button type="submit">Buat Pesanan</button>
                </form>
            </div>
            <button class="modal-close is-large" aria-label="close" @click="showModal = false"></button>
        </div>
    </div>
</template>

<style>
/* Gaya untuk modal */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
}

.is-active {
    display: flex;
}

.modal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 400px;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    border: none;
    background-color: transparent;
    cursor: pointer;
}
</style>
