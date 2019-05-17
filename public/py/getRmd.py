from pyspark import SparkConf, SparkContext
conf = SparkConf().setMaster("local[*]").setAppName("RankModel")
sc = SparkContext(conf=conf)

from pyspark.mllib.recommendation import Rating
from pyspark.mllib.recommendation import ALS

# model = ALSModel.load("rmd_model")
# recommend = model.recommendProducts(100, 3) 
# for p in recommend:
#     print(f"[user_id: {p[0]}, food_id: {p[1]}, rank: {p[2]}]") 