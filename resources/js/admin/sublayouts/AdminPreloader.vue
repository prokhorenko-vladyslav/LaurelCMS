<template>
    <transition name="fade">
    <div class="preloader" v-show="!loaded">
        <div class="wrapper">
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    </transition>
</template>

<script>
    import {mapState} from "vuex";

    export default {
        name: "AdminPreloader",
        computed: {
            ...mapState(['loaded'])
        }
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        background: #313746;
        background-size: cover;
        z-index: 100;
    }

    @mixin obj($w,$h,$bg) {
        width: $w;
        height: $h;
        background: $bg;
    }

    @mixin anim($listName,$delay){
        @each $currentBox in $listName {
            $i: index($listName, $currentBox);
            &:nth-child(#{$currentBox}) {
                animation-delay: 0.1s * $i + $delay;
            }
        }
    }

    .wrapper {
        @include obj(auto,auto,null);
    }

    ul {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        animation:rot 16s linear infinite;
        @keyframes rot {
            100% {
                transform:rotate(360deg);
            }
        }
    }

    li {
        @include obj(40px,40px,#651FFF);
        border-radius:4px;
        box-shadow: 0 0 1px #fff, 0 0 5px #651FFF, 0 0 10px #651FFF, 0 0 15px #651FFF, 0 0 25px #651FFF, 0 0 55px #651FFF;
        animation: scale 0.8s linear alternate infinite;

        @keyframes scale {
            100% {
                transform: scale(.1);
                opacity: 0;
            }
        }
        @for $i from 1 through 25 {
            &:nth-child(#{$i}) {
                z-index: 25 - $i;
            }
        }
        @for $i from 1 through 5 {
            &:nth-child(#{$i}) {
                animation-delay: 0.1s * $i;
            }
            &:nth-child(#{$i + 6}) {
                @if ($i<5) {
                    animation-delay: 0.1s * $i + 0.2s;
                }
            }
            &:nth-child(#{$i + 12}) {
                @if ($i<4) {
                    animation-delay: 0.1s * $i + 0.4s;
                }
            }
            &:nth-child(#{$i + 18}) {
                @if ($i<3) {
                    animation-delay: 0.1s * $i + 0.6s;
                }
            }
            &:nth-child(#{$i + 23}) {
                @if ($i<2) {
                    animation-delay: 0.1s * $i + 0.8s;
                }
            }
        }

        $fCol: 1 6 11 16 21;
        @include anim($fCol,0);

        $sCol: 7 12 17 22;
        @include anim($sCol,0.2s);

        $tCol: 13 18 23;
        @include anim($tCol,0.4s);

        $foCol: 19 24;
        @include anim($foCol,0.6s);

        &:nth-child(25) {
            animation-delay: 0.9s;
        }
    }


</style>
