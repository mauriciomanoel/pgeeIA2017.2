

import java.util.Arrays;
import java.util.Random;

public class Layer {

	private float[] output;
	private float[] input;
	private float[] weights;
	private float[] dWeights;
	private Random random;

	public Layer(int inputSize, int outputSize) {
		output = new float[outputSize];
		input = new float[inputSize + 1];
		weights = new float[(1 + inputSize) * outputSize];
		dWeights = new float[weights.length];
		this.random = new Random();
		initWeights();
	}

	// init of weights
	public void initWeights() {
		for (int i = 0; i < weights.length; i++) {
			weights[i] = (random.nextFloat() - 0.5f) * 4f; // [-2,2]
		}
	}

	public float[] run(float[] inputArray) {
		
		System.arraycopy(inputArray, 0, input, 0, inputArray.length);
		input[input.length - 1] = 1; // bias
		int offset = 0;
		
		for (int i = 0; i < output.length; i++) {
			for (int j = 0; j < input.length; j++) {
				output[i] += weights[offset + j] * input[j];
			}
			output[i] = ActivationFunction.sigmoid(output[i]);
			offset += input.length;
		}
		
		return Arrays.copyOf(output, output.length);
	}

	public float[] train(float[] error, float learningRate, float momentum) {
		
		int offset = 0;
		float[] nextError = new float[input.length];
		
		for (int i = 0; i < output.length; i++) {
			
			float delta = error[i] * ActivationFunction.dSigmoid(output[i]);
			
			for (int j = 0; j < input.length; j++) {
				int previousWeightIndex = offset + j;
				nextError[j] = nextError[j] + weights[previousWeightIndex] * delta;
				float dw = input[j] * delta * learningRate;
				weights[previousWeightIndex] += dWeights[previousWeightIndex] * momentum + dw;
				dWeights[previousWeightIndex] = dw;
			}
			
			offset += input.length;
		}
		
		return nextError;
	}
}

