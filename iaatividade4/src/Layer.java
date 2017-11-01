

import java.util.Arrays;
import java.util.Random;

public class Layer {

	private float[] output;
	private float[] input;
	private float[] weights;
	private float[] dWeights; // Previous weights
	private Random random;

	public Layer(int inputSize, int outputSize) {
		output = new float[outputSize];
		input = new float[inputSize + 1];
		weights = new float[(1 + inputSize) * outputSize];
		dWeights = new float[weights.length];
		this.random = new Random();
		initWeights();
	}

	public void initWeights() {
		for (int i = 0; i < weights.length; i++) {
			weights[i] = (random.nextFloat() - 0.5f) * 2f; //[-1,1]
		}
	}

	// Calculate ouput layer with the activations and weights
	public float[] run(float[] inputArray) {
		
		System.arraycopy(inputArray, 0, input, 0, inputArray.length);
		input[input.length - 1] = 1; 
		int offset = 0;
		
		for (int i = 0; i < output.length; i++) {
			for (int j = 0; j < input.length; j++) {
				output[i] += weights[offset + j] * input[j]; // Update parameters of output with weights
			}
			
			output[i] = ActivationFunction.sigmoid(output[i]);
			offset += input.length; // increment the offset because input and output do neuron one, two, ...
		}
		
		return Arrays.copyOf(output, output.length); // Copy of array
	}

	// implement the back propagation algorithm
	public float[] train(float[] error, float learningRate, float momentum) {
		
		int offset = 0;
		float[] nextError = new float[input.length];
		
		for (int i = 0; i < output.length; i++) {
			// calculate gradient the data for the output layer and fot the hidden layout
			float delta = error[i] * ActivationFunction.dSigmoid(output[i]); 
						
			// because we have a single hidden layer delta not change
			for (int j = 0; j < input.length; j++) {
				int previousWeightIndex = offset + j;
				// Calculate next error
				nextError[j] = nextError[j] + weights[previousWeightIndex] * delta;
				// Calculate changes with input, gradient and learing rate
				float dw = input[j] * delta * learningRate;
				// increment weights with weights previous times moment plus 
				weights[previousWeightIndex] += dWeights[previousWeightIndex] * momentum + dw;
				// save changes in weights previous
				dWeights[previousWeightIndex] = dw;
			}
			
			
			offset += input.length;
		}
		
		return nextError;
	}
}
