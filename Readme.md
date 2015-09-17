# Beijing AQI

**Beijing AQI**(Beijing **A**ir **Q**uality **I**ndex) is a script to show 24 hour air quality levels in one page.

It was designed for Little Printer by BERGCloud. I could get a brief air quality report every morning. This project was terminated because the Little Printer had been shut down.

AQI data comes from U.S. Department of State Air Quality Monitoring Program. There are data for five cities: Beijing, Chengdu, Guangzhou, Shanghai, and Shenyang.

## Usage
Deploy the everything (two PHP scripts and four PNG pictures) into your server. Create a crontab for **fetchpek.php** at 25 of every hour.

The scipt will generate a temp file named data.txt, please leave it alone.

Then you can access the homepage on your desktop or mobile device.

## License
Licensed under the Apache License, Version 2.0


#中文

**Beijing AQI**(Beijing **A**ir **Q**uality **I**ndex) 是一个整合 24 小时北京市空气质量情况的网页。

本项目原本为 BERGCloud 公司旗下 Little Printer 产品设计，每天早上可以拿到一份过去一天的空气质量报告。非常可惜的是，Little Printer 被关闭了。

空气质量数据来自美国国务院空气质量监测计划。目前覆盖五个城市，包括：北京，成都，广州，上海和沈阳。

## 用法
请将所有文件部署到服务器上。为 **fetchpek.php** 创建一个定时任务，每小时第 25 分时执行一次。

本脚本会产生一个名为 data.txt 的临时文件，请不要理会。

请使用电脑或移动设备访问首页。

## 授权
Licensed under the Apache License, Version 2.0
