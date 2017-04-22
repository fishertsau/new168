var ref_specs = [
    {
        title: '冰箱',
        specs: [
            {
                title: '冰冷效果',
                unit: '無單位',
                options: ['全冷凍', '全冷藏', '半凍半藏']
            },
            {
                title: '冷卻效果',
                unit: '無單位',
                options: ['管冷', '風冷']
            },
            {
                title: '壓縮機品牌',
                unit: '無單位',
                options: ['黑金剛', '愛惠普']
            }]
    },
    {
        title: '咖啡機',
        specs: [
            {
                title: '孔數', unit: '孔',
                options: [1, 2, 3]
            },
            {
                title: '功率',
                unit: '瓦(w)',
                options: [50, 100, 150, 200, 500]
            }]
    },
    {
        title: '製冰機',
        specs: [
            {
                title: '磅數', unit: '磅',
                options: [150, 200, 300]
            },
            {
                title: '容量', unit: '公升(L)',
                options: [20, 30, 40, 50, 60]
            }]
    }
];

export { ref_specs as default }