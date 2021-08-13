    var local = localStorage.getItem("local");

    if(local == null) {
        local = "ko-KR";
    }

    if(local === "en-US"){
        $(".kt-header__topbar-icon > img:nth-child(1)").addClass("nnnnnone")
        $(".kt-header__topbar-icon > img:nth-child(2)").removeClass("nnnnnone")
    }

    $.i18n.init({
        //lng: 'en-US',
        //lng: 'ko-KR',
        lng: local,
        debug: true,
        useLocalStorage: true,
        localStorageExpirationTime: 86400000, // in ms, default 1 week
        resStore: {
            "en-US": {
                "A": {
                    "LOGINTOP":"LOGIN",
                    "fp":"ALLOT STAKING PLATFORM",
                    "PWNOT":"Did you forget your password",
                    "PWFIND":"PASSWARD FIND",
                    "LOGIN": "LOGIN+",
                    "SINEUP":"SINE UP+",
                    "sineUp":"SINE UP",
                    "infor":"Please enter the information below.",
                    "Authenticationcode":"CODE",
                    "SUBSCRIPTION":"Do you already have a subscription account?"              
                },
                "L": {
                    "01":"Find Member Information",
                    "1":"Please enter the email address you registered when registering as a member.",            
                    "2":"We will send you the ID and password information by email.",            
                    "2-1":"Please enter the number of automatic registration protection in order.",            
                    "3":"Confirm member password",            
                    "4":"Please enter your password one more time.",            
                    "5":"If you enter your password, the member withdrawal is completed.",            
                    "6":"To keep your information safe, we'll check your password one more time.",            
                },
                "sidebar": {
                    "main":"main",
                    "Dashboard":"ALLOT HOMEPAGE",
                    "Account":"Account",
                    "User":"User",
                    "Modifyinginformation":"Modifying information",
                    "Bonus":"Bonus info",
                    "total":"Total bonus",
                    "ALT":"ALT STAKING",
                    "USD":"USD STAKING",
                    "Purchase":"Purchase",
                    "Purchasedetails":"Purchase details",
                    "ECT":"ECT",
                    "withdrawalapplication":"withdrawal application",
                    "withdrawalstatus":"withdrawal status",
                    "LOGOUT":"LOGOUT"
                },
                "INDEX": {
                    "MYPACKAGE":"MY PACKAGE",
                    "myrateofreturn":"MY RATE OF RETURN",
                    "PACKAGEDDAY":"PACKAGE D-DAY",
                    "availableassets":"AVAILABLE ASSETS",
                    "myreward":"MY REWARD",
                    "mycumulativecompensation":"My cumulative compensation",
                    "cumulativecompensationamount":"compensation",
                    "compensationratio":"Compensation ratio",
                    "compensationlist":"Compensation list",
                    "compensationofthedays":"Compensation of the day's",
                    "thetotalamountofcompensationfortoday":"The total amount of compensation for today",
                    "rwd":"Reward", 
                },
                "BONUSALL": {
                    "breakdown":"BREAKDOWN",
                    "DATE":"DATE",
                    "CONTENT":"CONTENT",
                    "BONUS":"BONUS",
                    "DONATION":"DONATION",
                    "FEE":"FEE",
                    "Remaining":"REMAINING",
                    "Allowance":"Allowance"
                },
                "ALT": {
                    "A":"ALT STAKING withdrawal",
                    "A1":"USD STAKING withdrawal",
                    "B":"1) When ALT prices fall,",
                    "C":"- If the ALT price falls on the date of withdrawal compared to the start date of the subscription, the payment will be made after deducting 50% of the principal.",
                    "D":"ex) 500,000 = 250,ALT payment",
                    "E":"2) When ALT prices rise",
                    "F":"- In the event of withdrawal of interim platform subscription, 50% less of USD base value after calculating ALT as USD conversion value as of the start date of subscription.",
                    "G":"ex) $0.03 X $500,000 ALT = $15,000",
                    "H":"$7,500 after 50% deduction = $0.1 present price",
                    "I":"7,500 / 0.1 = 75,000ALT Payment",
                    "I-i":"※ Please make a careful decision on this steaking service as there may be a high risk of falling prices.",
                    "J":"I agree to the above agreement.",
                    "K":"Purchase",
                    "L":"ETH(ALT) ADDRESS",
                    "M":"Copy Address",
                    "N":"ALT to be deposited : ",
                    "O":"Please enter the TXID address after sending.",
                    "P":"CANCEL",
                    "Q":"SUBMIT",
                    "1":"- If the platform progresses and the subscription is withdrawn, 50% deduction and payment will be made to the principal on the date of withdrawal compared to the subscription start date",
                    "2":"ex) 100,000 USD X 50% = 50,000 USD paid",
                    "3":"ex) 50,000 USD X 50% = 25,000 USD paid",
                    "4":"ex) 10,000 USD X 50% = 5,000 USD paid",
                    "4-1":" * It is calculated as 1 USD = 1200 KRW. * ",
                    "5":"application for withdrawal of subscription",
                    "6":"withdrawal address",
                    "7":"withdrawal ALT",
                    "8":"application",
                    "kk":"◆ The deposit of 500,000ALT can be withdrawn on the last day of the selected plan. ◆",
                    "kkk":"◆ ALT quantity converted to USD you deposited can be withdrawn on the last day of the steak. ◆",
                    "1234":"Please make a deposit within two hours."
                },
                "PURCHASE": {
                    "1":"Purchase details",
                    "2":"Package name",
                    "3":"DATE",
                    "4":"Deposit ALT",
                    "5":"rate",
                    "6":"price",
                    "7":"DAY",
                    "8":"State",
                    "9":"Function",
                    "10":"ongoing",
                    "11":"Completion",
                    "12":"withdrawal",
                    "97":"wait",
                    "98":"examination",
                    "99":"completed"
                },
                "WITHDRAWAL": {
                    "1":"Withdrawal (ALT)",
                    "2":"Withdrawal (USD)",
                    "3":"Withdrawalable",
                    "4":"minimum withdrawal amount",
                    "5":"Fee",
                    "6":"Withdrawal application",
                    "7":"Final withdrawal",
                    "8":"withdrawal address",
                    "9":"Application"
                },
                "WITHDRAWALBD": {
                    "1":"Withdrawal status",
                    "2":"Base price",
                    "3":"Receive (ALT)",
                    "4":"State",
                    "5":"Approval",
                    "6":"Hold",
                },
            },
            "ko-KR": {
                "A": {
                    "LOGINTOP":"로그인",
                    "fp":"ALLOT 스테이킹 플랫폼",
                    "PWNOT":"비밀번호를 잊으셨나요?",
                    "PWFIND":"비밀번호 찾기",
                    "LOGIN": "로그인+",
                    "SINEUP":"회원가입+",
                    "sineUp":"회원가입",
                    "infor":"아래 정보를 입력하세요",
                    "Authenticationcode":"인증코드",
                    "SUBSCRIPTION":"이미 가입한 계정이 있으신가요?"
                },
                "L": {
                    "01":"회원정보 찾기",
                    "1":"회원가입 시 등록하신 이메일 주소를 입력해 주세요.",            
                    "2":"해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.",            
                    "2-1":"자동등록방지 숫자를 순서대로 입력하세요.",            
                    "3":"회원 비밀번호 확인",            
                    "4":"비밀번호를 한번 더 입력해주세요.",            
                    "5":"비밀번호를 입력하시면 회원탈퇴가 완료됩니다.",            
                    "6":"회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.",             
                },
                "sidebar": {
                    "main":"메인",
                    "Dashboard":"ALLOT 홈페이지",
                    "Account":"계정",
                    "User":"사용자",
                    "Modifyinginformation":"정보 수정",
                    "Bonus":"보너스내역관리",
                    "total":"전체 보너스",
                    "ALTplus":"ALT STAKING 보너스 (ALT)",
                    "ALTplusplus":"USD STAKING 보너스 (USD)",
                    "Purchase":"구매",
                    "Purchasedetails":"구매 내역",
                    "ECT":"기타",
                    "withdrawalapplication":"출금 신청",
                    "withdrawalstatus":"출금 현황",
                    "LOGOUT":"로그아웃"
                },
                "INDEX": {
                    "MYPACKAGE":"나의 패키지",
                    "myrateofreturn":"나의 수익률",
                    "PACKAGEDDAY":"패키지 D-DAY",
                    "availableassets":"사용 가능 자산",
                    "myreward":"나의 보상",
                    "mycumulativecompensation":"나의 누적 보상",
                    "cumulativecompensationamount":"누적 보상액",
                    "compensationratio":"누적 보상 비율",
                    "compensationlist":"누적 보상 리스트",
                    "compensationofthedays":"오늘의 보상",
                    "thetotalamountofcompensationfortoday":"오늘의 총 보상액",
                    "rwd":"보상", 
                },
                "BONUSALL": {
                    "breakdown":"내역",
                    "DATE":"일시",
                    "CONTENT":"내용",
                    "BONUS":"보너스",
                    "DONATION":"기부",
                    "FEE":"수수료",
                    "Remaining":"잔액",
                    "Allowance":"수당"
                },
                "ALT": {
                    "A":"ALT STAKING (ALT) 청약철회 약정,",
                    "A1":"USD STAKING (USD) 청약철회 약정,",
                    "B":"1) ALT 가격 하락시",
                    "C":"- 플랫폼 진행 중간 청약 철회시 청약시작일 기준대비 철회하는날에 ALT가격이 하락시 원금에 50%차감후 지급",
                    "D":"ex) 500,000 = 250,000ALT지급",
                    "E":"2) ALT 가격 상승시",
                    "F":"- 플랫폼 진행 중간 청약 철회시 청약시작일 기준 USD환산값으로 ALT계산후 USD기준값의 50% 차감후 지급",
                    "G":"ex) 시작기준 가격 $0.03 X 500,000 ALT = $15,000",
                    "H":"50%차감후 $7,500 = 현재가격이 $0.1 일때",
                    "I":"7,500 / 0.1 = 75,000ALT 지급",
                    "I-i":"※ 본 스테이킹 서비스는 가격 하락시 높은 위험이 있을수 있으니 신중히 결정하여 주시기 바랍니다.",
                    "J":"위 약정에 동의합니다",
                    "K":"구매하기",
                    "L":"ALT STAKING 주소",
                    "M":"주소 복사",
                    "N":"입금하실 ALT :",
                    "O":"전송 후 TXID주소를 입력하여 주세요",
                    "P":"취소",
                    "Q":"확인",
                    "1":"- 플랫폼 진행 중간 청약 철회시 청약시작일 기준대비 철회하는날 원금에 50%차감후 지급",
                    "2":"ex) 100,000 USD X 50% = 50,000 USD 지급",
                    "3":"ex) 50,000 USD X 50% = 25,000 USD 지급",
                    "4":"ex) 10,000 USD X 50% = 5,000 USD 지급",
                    "4-1":" ※ 1 USD = 1200원 으로 계산됩니다.",
                    "5":"청약철회 신청하기",
                    "6":"출금 주소",
                    "7":"출금 ALT",
                    "8":"철회신청",
                    "kk":"◆ 예치하신 ALT는 선택하신 플랜의 마지막날 출금이 가능하며 리워드는 매일 오전 정산 지급됩니다. ◆",
                    "kkk":"◆ 예치하신 USD로 환산된 ALT수량은 스테이킹 마지막날 출금이 가능하며 리워드는 매일 오전 정산 지급됩니다. ◆",
                    "1234":"2시간 이내에 입금하여 주십시오."
                },
                "PURCHASE": {
                    "1":"구매 내역",
                    "2":"패키지명",
                    "3":"구매 일시",
                    "4":"입금 ALT",
                    "5":"이율",
                    "6":"구매당시 단가",
                    "7":"일 수",
                    "8":"상태",
                    "9":"기능",
                    "10":"철회진행중",
                    "11":"철회완료",
                    "12":"청약철회",
                    "97":"대기",
                    "98":"검사중",
                    "99":"구매완료"
                },
                "WITHDRAWAL": {
                    "1":"출금 신청하기 (ALT)",
                    "2":"출금 신청하기 (USD)",
                    "3":"출금가능",
                    "4":"최소 출금 금액",
                    "5":"출금 수수료",
                    "6":"출금 신청",
                    "7":"최종 출금",
                    "8":"출금 주소",
                    "9":"출금신청"
                },
                "WITHDRAWALBD": {
                    "1":"출금 현황",
                    "2":"기준가(ALT)",
                    "3":"받으실 (ALT)",
                    "4":"상태",
                    "5":"승인",
                    "6":"대기"
                },
            }
        }
    }, function () {
        $('#cont_wrap,#kt_aside,#kt_content,.kt-container,#ALTpluswrap,#ALTppwrap,#cancel,#dnbppwrap,#dnbpluswrap,#wrapper').i18n();
    });

    var changeLang = function (lang) {
        $.i18n.setLng(lang);
        $('#cont_wrap,#kt_aside,#kt_content,.kt-container,#ALTpluswrap,#ALTppwrap,#cancel,#dnbppwrap,#dnbpluswrap,#wrapper').i18n();
        
    }



    $(document).ready(function(){
        click();
    })

    function click(){
        $(".koo").click(function(){
            $(".kt-header__topbar-icon > img:nth-child(2)").addClass("nnnnnone")
            $(".kt-header__topbar-icon > img:nth-child(1)").removeClass("nnnnnone")
            localStorage.setItem("local", "ko-KR");
        })
        $(".enn").click(function(){
            $(".kt-header__topbar-icon > img:nth-child(1)").addClass("nnnnnone")
            $(".kt-header__topbar-icon > img:nth-child(2)").removeClass("nnnnnone")
            localStorage.setItem("local", "en-US");
        })
    }
