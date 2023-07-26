import numpy as np
import tensorflow as tf
import pickle
import argparse

parser = argparse.ArgumentParser()
parser.add_argument('string', help="string to be decoded")
args = parser.parse_args()
string = args.string


def data2char_index(X, max_len):
    alphabet = " abcdefghijklmnopqrstuvwxyz0123456789-,;.!?:'\"/\\|_@#$%^&*~`+-=<>()[]\{\}"
    result = []
    for data in X:
        mat = []
        for ch in data:
            ch = ch.lower()
            if ch not in alphabet:
                continue
            mat.append(alphabet.index(ch))
        result.append(mat)
    X_char = tf.keras.preprocessing.sequence.pad_sequences(np.array(result, dtype=object), padding='post',
                                                           truncating='post', maxlen=max_len)
    return X_char


with open('C:/Users/abhin/Documents/GitHub/xampp/htdocs/Minor-Project/Backend/final.pkl', 'rb') as f:
    model = pickle.load(f)

# string = "hello"

string_index = data2char_index([string], 1000)
# print the final output
output = model.predict(string_index)
for line in output:
    print(line)

# output = str(output)
# second_line = output.split('\n')[1]

# # Print the second line
# print(second_line)
