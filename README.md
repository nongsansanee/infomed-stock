## How to Add Font Thai Sarabun

1. สร้าง folder /js/Themes
2. สร้างไฟล์ theme.css (ต้นฉบับเอามาจาก primevue  แล้วมา modify เพิ่ม font-family:Sarabun)
3. ที่ไฟล์ app.js ไป import '@/Themes/theme.css' 
4. ที่ไฟล์ app.blade.php เพิ่ม style
   `<style>
            @font-face {
                font-family: 'Sarabun';
                src: url("{{ asset('fonts/Sarabun-Regular.ttf') }}");
            }
            body {
                font-family: 'Sarabun';
                /* background-color: #FCFCFC; */
            }
    </style>`
5. สร้าง folder /js/Themes/fonts
6. นำไฟล์ font ที่ต้องการมาวาง
7. npm run watch
8. copy file Sarabun-Regular.ttf ไปวางที่ /public/fonts/ เอง เนื่องจาก webpack ไม่ compile ให้

**ข้อควรระวัง**
ที่ไฟล์ app.blade.php ที่ `<body>` ต้องไม่กำหนด style class font ซ้ำซ้อน 
