# Challenge Name

XmeAqn - Ze Xiang

## Description
Write a function that takes two equal-length buffers and produces their XOR combination. 

value1 = "73757065726d616e20686174652062617473"
value2 = "6261746d616e206c6f766573207375706572"

*Use produced combination to fill the blanks LNC2022{C_ _ _r_ _ _}(no spaces in-between)*

-1st character use 24th character of the produced combination
-2nd character use 18th character of the produced combination
-3rd character use 20th character of the produced combination
-4th character use 4th character of the produced combination
-5th character use 5th character of the produced combination
-6th character use 6th character of the produced combination

## Hint
1. Fixed OXR

## Solution:

hex_value1 = "73757065726d616e20686174652062617473"
hex_value2 = "6261746d616e206c6f766573207375706572"

#step 1-2
bin_value1 = bin(int(hex_value1, 16))[2:]
bin_value2 = bin(int(hex_value2, 16))[2:]

#step 3
desired_length = len(bin_value1) if len(bin_value1) > len(bin_value2) else len(bin_value2)
bin_value1 = bin_value1.zfill(desired_length)
bin_value2 = bin_value2.zfill(desired_length)

#step 4
result = [int(bit1) ^ int(bit2) for bit1,bit2 in zip(bin_value1,bin_value2)]
string_result = "".join([str(bits) for bits in result])

#step 5
final_output = hex(int(string_result, 2))[2:]
print(final_output)

result:11140408130341024f1e0407455317111101

Video Demo: https://drive.google.com/drive/folders/1UcUSxmTgWD0TqHilvuFfi5OegMOm0DEz?usp=sharing

$$ Flag
`LNC2022{C7fer404}`
