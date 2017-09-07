option = {
    title : {
        text: '用户购买网站',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['淘宝','京东','苏宁','网易考拉','其他']
    },
    series : [
        {
            name: '购买网站',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'其他'},
                {value:310, name:'京东'},
                {value:234, name:'苏宁'},
                {value:135, name:'网易考拉'},
                {value:1548, name:'淘宝'}
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};
