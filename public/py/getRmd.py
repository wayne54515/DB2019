import csv
import sys
import json
from pyspark import SparkConf, SparkContext
conf = SparkConf().setMaster("local[*]").setAppName("RankModel")
sc = SparkContext(conf=conf)

from pyspark.mllib.recommendation import Rating
from pyspark.mllib.recommendation import ALS

user_id = int(sys.argv[1])

csv = sc.textFile("rank_data.csv")
# print(csv.collect())

data = csv.map(lambda line:line.split(","))

header = data.first()
rank_data = data.filter(lambda x: x!=header)
# rank_data.take(5)

model = ALS.train(rank_data, 10, 10, 0.01)
# print(model)

recommend = model.recommendProducts(user_id, 3) 
# for p in recommend:
#     print(f"[user_id: {p[0]}, food_id: {p[1]}, rank: {p[2]}]") 
print(recommend)
result = []
for rmd in recommend:
    result.append({'user_id': rmd[0], 'food_id': rmd[1], 'rank': round(rmd[2], 2)})


with open('recommend.json', 'w') as f:
    json.dump(result, f)
f.close()

sc.stop()
