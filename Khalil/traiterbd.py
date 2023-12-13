import csv
import os
from collections import defaultdict
import math
import random
import json

csv_file = '/Applications/MAMP/htdocs/Khalil/sampled_train/annotations_metadata.csv'

texts = []
labels = []

with open(csv_file, newline='', encoding='utf-8') as csvfile:
    csv_reader = csv.reader(csvfile, delimiter=',')
    next(csv_reader)  

    for row in csv_reader:
        file_id, user_id, subforum_id, num_contexts, label = row

        labels.append(label)

        file_path = os.path.join('/Applications/MAMP/htdocs/Khalil/sampled_train/sampled_train', f'{file_id}.txt')

        if os.path.exists(file_path):
            with open(file_path, 'r', encoding='utf-8') as txt_file:
                text_content = txt_file.read()
                texts.append(text_content)
        else:
            texts.append('') 

document_frequency = defaultdict(int)

for text in texts:
    words = set(text.lower().split())  
    for word in words:
        document_frequency[word] += 1


N = len(texts)  
idf = {word: math.log(N / (1 + freq)) for word, freq in document_frequency.items()}


ScoreMap = {word: 0 for word in idf.keys()}  

for text, label in zip(texts, labels):
    words = text.lower().split()
    word_count = len(words) 
    term_frequency = {word: words.count(word) / word_count for word in set(words)}

    for word, tf in term_frequency.items():
        tf_idf = tf * idf[word]

        if label == "hate":
            ScoreMap[word] -= tf_idf
        else:
            ScoreMap[word] += tf_idf

random_text_index = random.randint(0, len(texts) - 1)

random_text = texts[random_text_index]

sum_values = sum(ScoreMap[word] for word in random_text.lower().split())

if sum_values > 0:
    print("Le message est valide.")
else:
    print("Le message est invalide.")


with open('ScoreMap.json', 'w', encoding='utf-8') as json_file:
    json.dump(ScoreMap, json_file, ensure_ascii=False, indent=4)

