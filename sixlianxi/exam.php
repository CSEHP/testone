<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>考试答题</title>
</head>
<body>
<div class="main">
    <h3>考试答题</h3>
    <!-- 题目内容 -->
    <!--    要求：提交数据到total.php，并在该文件中输出提交数据  -->
    <form method="post" action="total.php">
        <!-- 单选题 -->
        <div>
            <div class="question-type">一、单选题</div>
            <div class="question-each">
                <!-- 标题 -->
                <div>1. 运算器主要用于（&nbsp;）。</div>
                <!-- 选项 -->
                <div class="question-option">
                    <input type="radio" value="A" name="single[1]" id="1.1" required><label for="1.1">A. 四则运算</label>
                    <input type="radio" value="B" name="single[1]" id="1.2" required><label for="1.2">B. 逻辑判断</label><br/>
                    <input type="radio" value="C" name="single[1]" id="1.3" required><label for="1.3">C. 传送数据</label>
                    <input type="radio" value="D" name="single[1]" id="1.4" required><label for="1.4">D. 算术运算和逻辑运算</label>
                </div>
            </div>
            <div class="question-each">
                <!-- 标题 -->
                <div>2. 以下不属于计算机外存储器的是（）。</div>
                <!-- 选项 -->
                <div class="question-option">
                    <input type="radio" value="A" name="single[2]" id="2.1" required><label for="2.1">A. 磁带</label>
                    <input type="radio" value="B" name="single[2]" id="2.2" required><label for="2.2">B. 硬盘</label><br/>
                    <input type="radio" value="C" name="single[2]" id="2.3" required><label for="2.3">C. 软盘</label>
                    <input type="radio" value="D" name="single[2]" id="2.4" required><label for="2.4">D. RAM</label>
                </div>
            </div>
        </div>
        <!-- 多选题 -->
        <div>
            <div class="question-type">二、多选题</div>
            <div class="question-each">
                <!-- 标题 -->
                <div>1. 下列选项中，不正确的是（&nbsp;）。</div>
                <!-- 选项 -->
                <div class="question-option">
                    <input type="checkbox" value="A" id="3.1" name="multiple[1][]"><label for="3.1">A. 计算机非正常关机后，ROM中的信息消失</label><br/>
                    <input type="checkbox" value="B" id="3.2" name="multiple[1][]"><label for="3.2">B.计算机非正常关机后，ROM中的信息消失</label><br/>
                    <input type="checkbox" value="C" id="3.3" name="multiple[1][]"><label for="3.3">C.计算机非正常关机后，ROM与RAM中的信息均消失</label><br/>
                    <input type="checkbox" value="D" id="3.4" name="multiple[1][]"><label for="3.4">D.计算机非正常关机后，ROM与RAM中的信息均不消失</label><br/>
                </div>
            </div>
            <div class="question-each">
                <!-- 标题 -->
                <div>2. 信息安全包括（）。</div>
                <!-- 选项 -->
                <div class="question-option">
                    <input type="checkbox" value="A" id="4.1" name="multiple[2][]"><label for="4.1">A. 信息的安全</label><br/>
                    <input type="checkbox" value="B" id="4.2" name="multiple[2][]"><label for="4.2">B. 系统</label><br/>
                    <input type="checkbox" value="C" id="4.3" name="multiple[2][]"><label for="4.3">C. 网络安全</label><br/>
                    <input type="checkbox" value="D" id="4.4" name="multiple[2][]"><label for="4.4">D. 传递安全</label><br/>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" value="交卷" class="btn">
        </div>
    </form>
</div>

</body>
</html>