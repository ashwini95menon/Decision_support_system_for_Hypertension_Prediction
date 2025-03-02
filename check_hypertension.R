library(methods)
library(DBI)
library(RMySQL)
library(shiny)
library(RWeka)
library(rJava)
library(datasets)
library(tree)
library(randomForest)

#accepting values from php file
args <- commandArgs(trailingOnly=TRUE)

age_ip<-as.integer(args[1])
height_ip<-as.integer(args[2])
weight_ip<-as.numeric(args[3])
pulse_ip<-as.integer(args[4])
chol_ip<-as.numeric(args[5])
smoke_ip<-as.integer(args[6])
exercise_ip<-as.integer(args[7])
uname<-args[8]
day<-as.integer(args[9])
month<-as.integer(args[10])
year<-as.integer(args[11])
hour<-as.integer(args[12])
minute<-as.integer(args[13])
second<-as.integer(args[14])
date_ip<-args[15]

x<-as.integer(0)
y<-as.integer(0)

#WPM("refresh-cache")

#-----------insert query for cross-checking-------------
#con <- dbConnect(MySQL(), user="root",dbname="db")
#dbExistsTable(con, "healthdetails")
#sql_command <- paste("INSERT into healthdetails(age,Transaction_Id,height,weight,waist,pulse,cholesterol,smoke,exercise,systolic,username,day,month,year,hour,minute,second,Date) VALUES ('",age_ip,"',' ','",height_ip,"','",weight_ip,"',' ','",pulse_ip,"','",chol_ip,"','",smoke_ip,"','",exercise_ip,"',' ','",uname,"','",day,"','",month,"','",year,"','",hour,"','",minute,"','",second,"','",date_ip,"');", sep = "")
#rs<-dbSendQuery(con,sql_command)
#df<- fetch(rs,n=-1)
#all_cons <- dbListConnections(MySQL())
#dbClearResult(rs)
#for(con in all_cons)
#dbDisconnect(con)
#-------------------------------------------------------

con <- dbConnect(MySQL(), user="root",dbname="db")
dbExistsTable(con, "health")
sql_command <- "SELECT h.age,h.ht,h.wt,h.pulse,h.sys,h.chol FROM health h"
rs<-dbSendQuery(con,sql_command)
df<- fetch(rs,n=-1)
#tmp<-as.numeric(df$sys)
#LinearRegression(df$sys~. ,data=df)
modelLR <-randomForest(df$sys~.,data=df)
#modelLR
testdata=data.frame(age<-age_ip,ht<-height_ip,wt<-weight_ip,pulse<-pulse_ip,chol<-chol_ip)
#waist
predictions <- predict(modelLR, newdata = testdata)
#predictions
x<-as.integer(predictions)
#x
all_cons <- dbListConnections(MySQL())
dbClearResult(rs)
for(con in all_cons)
  dbDisconnect(con)

con <- dbConnect(MySQL(), user="root",dbname="db")
sql_command <- "SELECT h.age,h.ht,h.wt,h.pulse,h.dias,h.chol FROM health h"
rs<-dbSendQuery(con,sql_command)
df<- fetch(rs,n=-1)
modelLR <- randomForest(df$dias~.,data=df)
testdata=data.frame(age<-age_ip,ht<-height_ip,wt<-weight_ip,pulse<-pulse_ip,chol<-chol_ip)
predictions2 <- predict(modelLR, newdata = testdata)
y<-as.integer(predictions2)
#y
all_cons <- dbListConnections(MySQL())
dbClearResult(rs)
for(con in all_cons)
  dbDisconnect(con)

con <- dbConnect(MySQL(), user="root",dbname="db")
sql_command <- "SELECT a.age,a.smokingstatus,a.exercise,a.weight,a.serumchol,a.systolic,a.hypertension from hypertension a"
rs<-dbSendQuery(con,sql_command)
df<- fetch(rs,n=-1)
LogitBoost.model <- LogitBoost(as.factor(df$hypertension)~ ., data = df)
#LogitBoost.model
testdata=data.frame(age<-age_ip,smokingstatus<-smoke_ip,exercise<-exercise_ip,weight<-weight_ip,serumchol<-chol_ip,systolic<-x,hypertension='')
predictions3 <- predict(LogitBoost.model, newdata = testdata)
all_cons <- dbListConnections(MySQL())
dbClearResult(rs)
for(con in all_cons)
  dbDisconnect(con)

con <- dbConnect(MySQL(), user="root",dbname="db")
dbExistsTable(con, "predictions")
sql_command <- paste("INSERT into predictions (Transaction_Id,age,height,weight,pulse,cholesterol,smoke,exercise,day,month,year,hour,minute,second,Date,sys,dias,predictions,username) VALUES (' ','",age_ip,"','",height_ip,"','",weight_ip,"','",pulse_ip,"','",chol_ip,"','",smoke_ip,"','",exercise_ip,"','",day,"','",month,"','",year,"','",hour,"','",minute,"','",second,"','",date_ip,"','",x,"','",y,"','",predictions3,"','",uname,"')", sep = "")
#sql_command <- paste("INSERT into predict VALUES ('",x,"','",y,"','",predictions3,"','",uname,"')", sep = "")
rs<-dbSendQuery(con,sql_command)
df<- fetch(rs,n=-1)
all_cons <- dbListConnections(MySQL())
dbClearResult(rs)
for(con in all_cons)
  dbDisconnect(con)


#z<-data.frame(x,y,predictions3)

#z
