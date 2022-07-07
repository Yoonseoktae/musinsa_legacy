# musinsa_legacy

＊기본 설명
  1. 프레임워크를 사용하지 않고 레거시코드를 활용한 MVC패턴 개발.
  2. aws서버 같은 계정안에서 포트로 구분하여 연결.

＊형상관리

  - Git 
    GitHub(master) : https://github.com/Yoonseoktae/musinsa_legacy/tree/master
    GitHub(dev) : https://github.com/Yoonseoktae/musinsa_legacy/tree/dev

  - versioning
    GitFlow


＊AWS 스펙

  - EC2 (프리티어)
    유형 : t2.nano
    EndPoint : ec2-3-38-252-196.ap-northeast-2.compute.amazonaws.com
  
  - RDS (프리티어)
    유형 : db.t3.micro
    EndPoint : db-musinsa-test.czigkq9mkg4m.ap-northeast-2.rds.amazonaws.com
    Port : 3306
    ID : yst


＊Server 스펙

  - Apache : 2.4.53
  - PHP : 7.4.29
  - Mysql : 8.0.28


＊사용 툴

  - VSCODE 
  - NaviCat 
  - putty
  - GitHub
  - GitDesktop
  - YARC (REST API test - Chrome extension)


＊테스트

    1. 상품조회 (GET)
      - http://3.38.252.196:8080/goods?mode=api&goods_no=1 (단일상품조회)
      - http://3.38.252.196:8080/goods?mode=api (전체상품조회)

    2. 상품등록 (POST)
      - http://3.38.252.196:8080/goods&mode=api (상품등록)
      - payload : {
          "goods_nm":"aa",
          "goods_cont":"dd",
          "com_id":"33"
        }

