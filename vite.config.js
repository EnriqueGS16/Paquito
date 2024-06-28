import {defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import { plugins } from 'chart.js'

//frfrf
export default defineConfig({
    plugins: [vue()],
    base: 'https://enriquegs16.github.io/techy-vue/'
})