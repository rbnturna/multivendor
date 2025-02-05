(function (jQuery) {
  "use strict";
if (document.querySelectorAll('#myChart').length) {
  const options = {
    series: [55,75,35,60],
    chart: {
    height: 230,
    type: 'radialBar',
  },
  colors: ["#3a57e8", "#4bc7d2", "#f4a261", "#e76f51", "#2a9d8f", "#264653", "#e9c46a"],
  plotOptions: {
    radialBar: {
      hollow: {
          margin: 0,
          size: "50%",
      },
      track: {
          margin: 0,
          strokeWidth: '80%',
          colors: ["#3a57e8", "#4bc7d2", "#f4a261", "#e76f51", "#2a9d8f", "#264653", "#e9c46a"],
      },
      dataLabels: {
          show: true,
      }
    }
  },
  labels: ['Apples', 'Oranges','banana','ss'],
  };
  if(ApexCharts !== undefined) {
    const chart = new ApexCharts(document.querySelector("#myChart"), options);
    chart.render();
    document.addEventListener('ColorChange', (e) => {
        const newOpt = {colors: [e.detail.detail2, e.detail.detail1],}
        chart.updateOptions(newOpt)
       
    })
  }
}
if (document.querySelectorAll('#d-activity').length) {
    const options = {
      series: [{
        name: 'Successful deals',
        data: [30, 50, 35, 60, 40, 60, 60, 30, 50, 35,]
      }, {
        name: 'Failed deals',
        data: [40, 50, 55, 50, 30, 80, 30, 40, 50, 55]
      }],
      chart: {
        type: 'bar',
        height: 230,
        stacked: true,
        toolbar: {
            show:false
          }
      },
      colors: ["#3a57e8", "#4bc7d2", "#f4a261", "#e76f51", "#2a9d8f", "#264653", "#e9c46a"],
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '28%',
          endingShape: 'rounded',
          borderRadius: 5,
        },
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['S', 'M', 'T', 'W', 'T', 'F', 'S', 'M', 'T', 'W'],
        labels: {
          minHeight:20,
          maxHeight:20,
          style: {
            colors: "#8A92A6",
          },
        }
      },
      yaxis: {
        title: {
          text: ''
        },
        labels: {
            minWidth: 19,
            maxWidth: 19,
            style: {
              colors: "#8A92A6",
            },
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "$ " + val + " thousands"
          }
        }
      }
    };
  
    const chart = new ApexCharts(document.querySelector("#d-activity"), options);
    chart.render();
    document.addEventListener('ColorChange', (e) => {
    const newOpt = {colors: [e.detail.detail1, e.detail.detail2],}
    chart.updateOptions(newOpt)
    })
  }
if (document.querySelectorAll('#d-main').length) {
  
  const options = {
      series: [{
          name: 'Sales',
          data: [94, 80, 100, 94, 80, 94, 194]
      }, {
          name: 'Profit',
          data: [10, 8, 12, 11, 7, 9, 19] 
      }],
      chart: {
          fontFamily: '"Inter", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
          height: 245,
          type: 'area',
          toolbar: {
              show: false
          },
          sparkline: {
              enabled: false,
          },
      },
      colors: ["#3a57e8", "#4bc7d2", "#f4a261", "#e76f51", "#2a9d8f", "#264653", "#e9c46a"], // Line colors updated
      dataLabels: {
          enabled: false
      },
      stroke: {
          curve: 'smooth',
          width: 3,
          colors: ["#3a57e8", "#4bc7d2", "#f4a261", "#e76f51", "#2a9d8f", "#264653", "#e9c46a"], // Ensure stroke follows the new colors
      },
      yaxis: {
          show: true,
          labels: {
              show: true,
              minWidth: 19,
              maxWidth: 19,
              style: {
                  colors: ["#3a57e8", "#4bc7d2", "#f4a261", "#e76f51", "#2a9d8f", "#264653", "#e9c46a"],
              },
              offsetX: -5,
          },
      },
      legend: {
          show: false,
      },
      xaxis: {
          labels: {
              minHeight: 22,
              maxHeight: 22,
              show: true,
              style: {
                  colors: ["#3a57e8", "#4bc7d2", "#f4a261", "#e76f51", "#2a9d8f", "#264653", "#e9c46a"],
              },
          },
          lines: {
              show: false // Disables x-axis grid lines
          },
          categories: ["Jan", "Feb", "Mar", "Apr", "Jun", "Jul", "Aug"]
      },
      grid: {
          show: false,
      },
      fill: {
          type: 'gradient',
          gradient: {
              shade: 'dark',
              type: "vertical",
              shadeIntensity: 0.4,
              gradientToColors: ["#3a57e8", "#4bc7d2", "#f4a261", "#e76f51", "#2a9d8f", "#264653", "#e9c46a"], // Match gradient with line colors
              inverseColors: false,
              opacityFrom: 0.4,
              opacityTo: 0.1,
              stops: [0, 50, 100],
          }
      },
      tooltip: {
          enabled: true,
      },
  };

  const chart = new ApexCharts(document.querySelector("#d-main"), options);
  chart.render();
  document.addEventListener('ColorChange', (e) => {
    console.log(e)
    const newOpt = {
      colors: [e.detail.detail1, e.detail.detail2],
      fill: {
        type: 'gradient',
        gradient: {
            shade: 'dark',
            type: "vertical",
            shadeIntensity: 0,
            gradientToColors: [e.detail.detail1, e.detail.detail2], // optional, if not defined - uses the shades of same color in series
            inverseColors: true,
            opacityFrom: .4,
            opacityTo: .1,
            stops: [0, 50, 60],
            colors: [e.detail.detail1, e.detail.detail2],
        }
    },
   }
    chart.updateOptions(newOpt)
  })
}
if ($('.d-slider1').length > 0) {
    const options = {
        centeredSlides: false,
        loop: false,
        slidesPerView: 4,
        autoplay:false,
        spaceBetween: 32,
        breakpoints: {
            320: { slidesPerView: 1 },
            550: { slidesPerView: 2 },
            991: { slidesPerView: 3 },
            1400: { slidesPerView: 3 },
            1500: { slidesPerView: 4 },
            1920: { slidesPerView: 6 },
            2040: { slidesPerView: 7 },
            2440: { slidesPerView: 8 }
        },
        pagination: {
            el: '.swiper-pagination'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },  

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar'  
        }
    } 
    let swiper = new Swiper('.d-slider1',options);

    document.addEventListener('ChangeMode', (e) => {
      if (e.detail.rtl === 'rtl' || e.detail.rtl === 'ltr') {
        swiper.destroy(true, true)
        setTimeout(() => {
            swiper = new Swiper('.d-slider1',options);
        }, 500);
      }
    })
}

})(jQuery)
