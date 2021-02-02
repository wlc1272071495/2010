async function judgeUser(user) {
    if (reg.test(user)) {   // 先验证规则 => 在判断用户名是否存在
        // 此回调函数的结果返回不出去   => 用Promise返回
        var result = await isExistUser({ user });
        if (result.status) {
            return result;
        } else {
            throw result;
        }

    } else {
        throw {
            status: false,
            msg: "用户名由数字,字母,下划线,$组成 6-12位,不能以数字开头"
        }
    }
}

// function judgeUser(user) {
//     // var user = userInp.value;
//     var reg = /^[a-zA-Z_$][\w$]{5,11}$/;
//     // 每次验证之前先重置为false
//     var p = new Promise(function (resolve, reject) {
//         if (reg.test(user)) {   // 先验证规则 => 在判断用户名是否存在

//             // 此回调函数的结果返回不出去   => 用Promise返回
//             isExistUser({ user }).then(result => {   // {status,msg}
//                 if (result.status) {
//                     resolve(result);
//                 } else {
//                     reject(result);
//                 }
//             })

//         } else {
//             reject({
//                 status: false,
//                 msg: "用户名由数字,字母,下划线,$组成 6-12位,不能以数字开头"
//             })
//         }
//     })
//     return p;
// }


async function judgePwd(pwd) {
    var reg = /^[\w$]{6,12}$/;
    if (reg.test(pwd)) {
        // pwdSpan.textContent = "√";
        // pwdSpan.className = "right";

        var numFlag = false;
        var smallFlag = false;
        var bigFlag = false;
        var speFlag = false;

        var numReg = /[0-9]/;
        var smallReg = /[a-z]/;
        var bigReg = /[A-Z]/;
        var speReg = /[_$]/;

        if (numReg.test(pwd)) {
            numFlag = true;
        }
        if (smallReg.test(pwd)) {
            smallFlag = true;
        }
        if (bigReg.test(pwd)) {
            bigFlag = true;
        }
        if (speReg.test(pwd)) {
            speFlag = true;
        }

        var sum = numFlag + smallFlag + bigFlag + speFlag;

        // pwdSpan.textContent = "密码强度:" + sum;
        // pwdSpan.className = "right";


        return {
            status: true,
            level: sum,
            msg: "密码强度:" + sum
        }


    } else {
        // pwdSpan.textContent = "密码由数字,字母,下划线,$组成 6-12位";
        // pwdSpan.className = "err";
        throw {
            status: false,
            msg: "密码由数字,字母,下划线,$组成 6-12位"
        }
    }
}

// function judgePwd(pwd) {
//     var reg = /^[\w$]{6,12}$/;
//     if (reg.test(pwd)) {
//         // pwdSpan.textContent = "√";
//         // pwdSpan.className = "right";

//         var numFlag = false;
//         var smallFlag = false;
//         var bigFlag = false;
//         var speFlag = false;

//         var numReg = /[0-9]/;
//         var smallReg = /[a-z]/;
//         var bigReg = /[A-Z]/;
//         var speReg = /[_$]/;

//         if (numReg.test(pwd)) {
//             numFlag = true;
//         }
//         if (smallReg.test(pwd)) {
//             smallFlag = true;
//         }
//         if (bigReg.test(pwd)) {
//             bigFlag = true;
//         }
//         if (speReg.test(pwd)) {
//             speFlag = true;
//         }

//         var sum = numFlag + smallFlag + bigFlag + speFlag;

//         // pwdSpan.textContent = "密码强度:" + sum;
//         // pwdSpan.className = "right";


//         return Promise.resolve({
//             status: true,
//             level: sum,
//             msg: "密码强度:" + sum
//         })


//     } else {
//         // pwdSpan.textContent = "密码由数字,字母,下划线,$组成 6-12位";
//         // pwdSpan.className = "err";
//         return Promise.reject({
//             status: false,
//             msg: "密码由数字,字母,下划线,$组成 6-12位"
//         })
//     }
// }


function judgeEmail(email) {
    var reg = /^\w{6,18}@\w+\.com$/;
    var p = new Promise(function (resolve, reject) {
        if (reg.test(email)) {

            isExistEmail({ email }).then(result => {   // {status,msg}
                if (result.status) {
                    resolve(result);
                } else {
                    reject(result);
                }
            })

        } else {
            reject({
                status: false,
                msg: "请输入正确的邮箱"
            })
        }
    })
    return p;
}

function judgePhone(phone) {
    var reg = /^1[3-9]\d{9}$/;
    var p = new Promise(function (resolve, reject) {
        if (reg.test(phone)) {
            isExistPhone({ phone }).then(result => {   // {status,msg}
                if (result.status) {
                    resolve(result);
                } else {
                    reject(result);
                }
            })

        } else {
            reject({
                status: false,
                msg: "请输入正确的手机号"
            })
        }
    })
    return p;
}


function judgeCode(code, _rand) {
    // var code = codeInp.value;  //用户输入的
    // var _rand = createCodeSpan.innerText;
    var reg = new RegExp(_rand, "i");
    if (code) {
        if (reg.test(code)) {
            return Promise.resolve({
                status: true,
                msg: "√"
            })
        } else {
            return Promise.reject({
                status: false,
                msg: "x"
            })
        }
    } else {
        return Promise.reject({
            status: false,
            msg: "请输入验证码"
        })
    }
}