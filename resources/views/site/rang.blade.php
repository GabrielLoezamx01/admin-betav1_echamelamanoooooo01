
<div v-if="sucursal.rang == 5">
    <div class="rating">
        <div class="stars">
            ★★★★★
        </div>
    </div>
</div>

<div v-if="sucursal.rang == 4">
    <div class="rating">
        <div class="stars">
            ★★★★
        </div>
    </div>
</div>

<div v-if="sucursal.rang == 3">
    <div class="rating">
        <div class="stars">
            ★★★
        </div>
    </div>
</div>

<div v-if="sucursal.rang == 2">
    <div class="rating">
        <div class="stars">
            ★★
        </div>
    </div>
</div>
<div v-if="sucursal.rang == 1">
    <div class="rating">
        <div class="stars">
            ★
        </div>
    </div>
</div>
{{--
<div class="rating">
    <p>4 estrellas</p>
    <div class="stars">
        ★★★★
    </div>
</div>

<div class="rating">
    <p>3 estrellas</p>
    <div class="stars">
        ★★★
    </div>
</div>

<div class="rating">
    <p>2 estrellas</p>
    <div class="stars">
        ★★
    </div>
</div>

<div class="rating">
    <p>1 estrella</p>
    <div class="stars">
        ★
    </div>
</div> --}}
