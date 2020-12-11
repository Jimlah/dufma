    let canceller = document.querySelector(".cancel")
    let del_item = document.querySelector("p.del_item");
    let del_modal = document.querySelector('.question');
    let backdrop_org = document.querySelector('.backdrop_org');
    let del_btns = document.querySelectorAll('.del_btn');
    let summary = document.querySelector(".wrapper > div.summ > div");
    let h1 = document.querySelector("h1.summ_h1");
    h1.addEventListener('mouseover', () => {
        summary.classList.add('show');
    })
    h1.addEventListener('mouseleave', () => {
        summary.classList.remove('show')
    })
    for (let i = 0; i < del_btns.length; i++) {
        del_btns[i].addEventListener('click', () => {
            var item = del_btns[i].parentElement.parentElement.querySelector('td:nth-of-type(2)').innerHTML;
            var quantity = del_btns[i].parentElement.parentElement.querySelector('td:nth-of-type(3)').innerHTML;
            del_item.textContent = item + ' (' + quantity + ')';
            del_modal.classList.add('question-shown');
            backdrop_org.classList.add('backdrop-shown')
        })
    }
    backdrop_org.addEventListener('click', () => {
        del_modal.classList.remove('question-shown');
        backdrop_org.classList.remove('backdrop-shown')
    })

    canceller.addEventListener('click', () => {
        del_modal.classList.remove('question-shown');
        backdrop_org.classList.remove('backdrop-shown')
    })
    try {

        // Recent Report 2
        const bd_brandProduct2 = 'rgba(0,181,233,0.9)'
        const bd_brandService2 = 'rgba(0,173,95,0.9)'
        const brandProduct2 = 'rgba(0,181,233,0.2)'
        const brandService2 = 'rgba(0,173,95,0.2)'

        var data3 = [52, 60, 55, 50, 65, 80, 57, 70, 105, 115]
        var data4 = [102, 70, 80, 100, 56, 53, 80, 75, 65, 90]

        var ctx = document.getElementById("recent-rep2-chart");
        if (ctx) {
            ctx.height = 230;
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', ''],
                    datasets: [
                        {
                            label: 'My First dataset',
                            backgroundColor: brandService2,
                            borderColor: bd_brandService2,
                            pointHoverBackgroundColor: '#fff',
                            borderWidth: 0,
                            data: data3

                        },
                        {
                            label: 'My Second dataset',
                            backgroundColor: brandProduct2,
                            borderColor: bd_brandProduct2,
                            pointHoverBackgroundColor: '#fff',
                            borderWidth: 0,
                            data: data4

                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: true,
                                color: '#f2f2f2'
                            },
                            ticks: {
                                fontFamily: "Poppins",
                                fontSize: 12
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                maxTicksLimit: 5,
                                stepSize: 50,
                                max: 150,
                                fontFamily: "Poppins",
                                fontSize: 12
                            },
                            gridLines: {
                                display: true,
                                color: '#f2f2f2'

                            }
                        }]
                    },
                    elements: {
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4,
                            hoverBorderWidth: 3
                        },
                        line: {
                            tension: 0
                        }
                    }


                }
            });
        }

    } catch (error) {
        console.log(error);
    }


// Percent Chart
    // Percent Chart
    var ctx = document.getElementById("percent-chart");
    if (ctx) {
      ctx.height = 280;
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          datasets: [
            {
              label: "My First dataset",
              data: [document.querySelector('.accepted_no').innerText,document.querySelector('.progress_no').innerText,document.querySelector('.shipped_no').innerText, document.querySelector('.progress_no').innerText ],
              backgroundColor: [
                '#1ab394',
                '#fa4251',
                '#fa4251',
                '#fa4251'
              ],
              hoverBackgroundColor: [
                '#1ab394',
                '#fa4251',
                '#fa4251',
                '#fa4251'
              ],
              borderWidth: [
                0, 0, 0, 0
              ],
              hoverBorderColor: [
                'transparent',
                'transparent',
                'transparent',
                'transparent'

              ]
            }
          ],
          labels: [
            'Accepted',
            'In Progress',
            'Shipped',
            'Delivered'
          ]
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          cutoutPercentage: 55,
          animation: {
            animateScale: true,
            animateRotate: true
          },
          legend: {
            display: false
          },
          tooltips: {
            titleFontFamily: "Poppins",
            xPadding: 15,
            yPadding: 10,
            caretPadding: 0,
            bodyFontSize: 16
          }
        }
      });
    }
