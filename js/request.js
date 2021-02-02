
// 将所有的ajax请求  用Promise 封装  => 返回一个Promise实例


// request 相当于对ajax进行了二次封装   先引入ajax.js  在引入此文件  
// 函数封装过程中  => 请求接口  => 传递数据

function request(url, params, type = "get") {
    return new Promise(function (resolve, reject) {
        $.ajax({
            type,
            url,
            data: {
                ...params
            },
            dataType: "json",
            success: function (result) {  // result  形式参数  表示请求成功时返回的数据
                resolve(result);
            }
        })
    })
}


// function register(params) {
//     return request("../php/register.php", params, "post");
// }
// function login(params) {  //{user, pwd}
//     return request("../php/login.php", params, "post");
// }

// function deleteGradeById(params) {   // {ids}
//     return request("../php/deleteGradeById.php", params);
// }

// const register = (params) => { return request("../php/register.php", params, "post") }

// 注册页面
const isExistUser = params => request("../php/isExistUser.php", params, "post");
const isExistPhone = params => request("../php/isExistPhone.php", params, "post");
const isExistEmail = params => request("../php/isExistEmail.php", params, "post");
const register = params => request("../php/register.php", params, "post");

// 注册页面
const login = params => request("../php/login.php", params, "post");

// 主页面
const deleteGradeById = params => request("../php/deleteGradeById.php", params, "get");

const searchAllGradeLimit = params => request("../php/searchAllGradeLimit.php", params, "post");

// 商品列表
const searchAllGoodsLimit = params => request("../php/searchAllGoodsLimit.php", params, "post");

// 商品详情
const searchGoodsByGoodsId = params => request("../php/searchGoodsByGoodsId.php", params);
const addToShoppingCar = params => request("../php/addToShoppingCar.php", params, "post");


// 购物车
const searchShoppingCarByUser = params => request("../php/searchShoppingCarByUser.php", params, "post");
const deleteShopCarById = params => request("../php/deleteShopCarById.php", params);




